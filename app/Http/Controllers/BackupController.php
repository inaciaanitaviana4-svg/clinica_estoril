<?php

namespace App\Http\Controllers;

use App\Models\HistoricoAtividade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BackupController extends Controller
{
    // Pasta onde todos os backups ficam guardados (dentro de storage/app/backups)
    private function pasta_backups(): string
    {
        $path = storage_path('app/backups');
        if (! is_dir($path)) mkdir($path, 0775, true);
        return $path;
    }

    private function verificar_admin(): bool
    {
        if (! session('id_utilizador')) return false;
        $utilizador = \App\Models\Utilizador::find(session('id_utilizador'));
        return $utilizador && $utilizador->id_admi && $utilizador->nivel_acesso == 0;
    }

    // ── VIEW ──────────────────────────────────────────────────
    public function mostrar_backup_admin()
    {
        if (! $this->verificar_admin()) return redirect('/login');
        $stats          = $this->obter_estatisticas();
        $zip_disponivel = class_exists('ZipArchive');
        $backups        = $this->listar_backups_guardados();
        return view('admin.backup', compact('stats', 'zip_disponivel', 'backups'));
    }

    // ── API estatísticas ──────────────────────────────────────
    public function api_estatisticas()
    {
        if (! $this->verificar_admin())
            return response()->json(['erro' => 'Sem permissão.'], 401);
        return response()->json($this->obter_estatisticas());
    }

    // ── Download SQL ──────────────────────────────────────────
    public function download_banco_dados()
    {
        if (! $this->verificar_admin()) return redirect('/login');

        $sql      = $this->gerar_sql_completo();
        $nome     = 'clinica_estoril_db_' . now()->format('Y-m-d_H-i-s') . '.sql';
        $caminho  = $this->pasta_backups() . DIRECTORY_SEPARATOR . $nome;

        // Guarda cópia local
        file_put_contents($caminho, $sql);

        $this->registar_backup('backup_banco_dados', 'Banco de Dados (SQL)', $nome);

        return response()->download($caminho, $nome, [
            'Content-Type' => 'application/octet-stream',
        ]);
        // Não apaga: fica em storage/app/backups/ para consulta posterior
    }

    // ── Download sistema completo ─────────────────────────────
    public function download_sistema_completo()
    {
        if (! $this->verificar_admin()) return redirect('/login');

        set_time_limit(600);
        ini_set('memory_limit', '512M');

        // Método 1: ZipArchive
        if (class_exists('ZipArchive')) {
            return $this->download_via_ziparchive();
        }

        // Método 2: PharData (tar.gz) — sem deleteFileAfterSend para garantir download
        if (class_exists('PharData')) {
            return $this->download_via_phardata();
        }

        // Método 3: comando zip do SO
        if ($this->comando_disponivel('zip')) {
            return $this->download_via_comando_zip();
        }

        // Fallback final: SQL completo
        return $this->download_fallback_sql_readme();
    }

    // ── Baixar backup já guardado ─────────────────────────────
    public function download_backup_guardado(string $nome)
    {
        if (! $this->verificar_admin()) return redirect('/login');

        // Segurança: só nome de ficheiro, sem paths
        $nome    = basename($nome);
        $caminho = $this->pasta_backups() . DIRECTORY_SEPARATOR . $nome;

        if (! file_exists($caminho))
            return back()->with('erro', 'Ficheiro de backup não encontrado.');

        $mime = str_ends_with($nome, '.sql')    ? 'application/octet-stream'
              : (str_ends_with($nome, '.tar.gz') || str_ends_with($nome, '.gz')
                    ? 'application/x-gzip' : 'application/zip');

        return response()->download($caminho, $nome, ['Content-Type' => $mime]);
    }

    // ── Apagar backup guardado ────────────────────────────────
    public function apagar_backup_guardado(string $nome)
    {
        if (! $this->verificar_admin())
            return response()->json(['erro' => 'Sem permissão.'], 401);

        $nome    = basename($nome);
        $caminho = $this->pasta_backups() . DIRECTORY_SEPARATOR . $nome;

        if (file_exists($caminho)) unlink($caminho);

        return response()->json(['ok' => true]);
    }

    // ═══════════════════════════════════════════════════════════
    //  COMPACTAÇÃO
    // ═══════════════════════════════════════════════════════════

    private function download_via_ziparchive()
    {
        $nome    = 'clinica_estoril_completo_' . now()->format('Y-m-d_H-i-s') . '.zip';
        $caminho = $this->pasta_backups() . DIRECTORY_SEPARATOR . $nome;

        $zip = new \ZipArchive();
        if ($zip->open($caminho, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true)
            return back()->with('erro', 'Não foi possível criar o ZIP.');

        $this->adicionar_pasta_ao_zip_archive($zip, base_path(), base_path(),
            ['vendor', 'node_modules', '.git', 'storage/app/backups', 'storage/logs']);

        $zip->addFromString('backup_database.sql', $this->gerar_sql_completo());
        $zip->addFromString('BACKUP_README.txt',   $this->gerar_readme('ZIP'));
        $zip->close();

        $this->registar_backup('backup_sistema_completo', 'Sistema Completo (ZIP)', $nome);

        return response()->download($caminho, $nome, [
            'Content-Type' => 'application/zip',
        ]);
    }

    private function download_via_phardata()
    {
        $nomeBase = 'backup_sistema_' . now()->format('Y-m-d_H-i-s');
        $pasta    = $this->pasta_backups();
        $tarPath  = $pasta . DIRECTORY_SEPARATOR . $nomeBase . '.tar';
        $gzPath   = $tarPath . '.gz';
        $nomeFinal = $nomeBase . '.tar.gz';

        if (file_exists($tarPath)) unlink($tarPath);
        if (file_exists($gzPath))  unlink($gzPath);

        try {
            $phar = new \PharData($tarPath);

            $raiz       = base_path();
            $excluirDir = [
                'vendor', 'node_modules', '.git',
                'storage' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'backups',
                'storage' . DIRECTORY_SEPARATOR . 'logs',
            ];

            $itens = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($raiz, \RecursiveDirectoryIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::SELF_FIRST
            );

            foreach ($itens as $item) {
                $relativo = ltrim(str_replace($raiz, '', $item->getRealPath()), DIRECTORY_SEPARATOR . '/');

                $excluir = false;
                foreach ($excluirDir as $dir) {
                    if (str_starts_with($relativo, $dir)) { $excluir = true; break; }
                }
                if ($excluir || ! $item->isFile()) continue;
                if ($item->getSize() > 30 * 1024 * 1024) continue;

                try { $phar->addFile($item->getRealPath(), $nomeBase . '/' . $relativo); }
                catch (\Exception $e) { /* ficheiro bloqueado, ignora */ }
            }

            // SQL e README dentro do tar
            $sqlTmp    = $pasta . DIRECTORY_SEPARATOR . 'tmp_sql.sql';
            $readmeTmp = $pasta . DIRECTORY_SEPARATOR . 'tmp_readme.txt';
            file_put_contents($sqlTmp,    $this->gerar_sql_completo());
            file_put_contents($readmeTmp, $this->gerar_readme('TAR.GZ'));
            $phar->addFile($sqlTmp,    $nomeBase . '/backup_database.sql');
            $phar->addFile($readmeTmp, $nomeBase . '/BACKUP_README.txt');

            // Comprime
            $phar->compress(\Phar::GZ);

            // Limpa temporários
            if (file_exists($tarPath))    unlink($tarPath);
            if (file_exists($sqlTmp))     unlink($sqlTmp);
            if (file_exists($readmeTmp))  unlink($readmeTmp);

        } catch (\Exception $e) {
            // PharData falhou — cai para SQL
            if (file_exists($tarPath)) unlink($tarPath);
            return $this->download_fallback_sql_readme();
        }

        if (! file_exists($gzPath))
            return $this->download_fallback_sql_readme();

        $this->registar_backup('backup_sistema_completo', 'Sistema Completo (TAR.GZ)', $nomeFinal);

        // Envia o ficheiro directamente com readfile para garantir download
        $tamanho = filesize($gzPath);
        header('Content-Description: File Transfer');
        header('Content-Type: application/x-gzip');
        header('Content-Disposition: attachment; filename="' . $nomeFinal . '"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . $tamanho);
        ob_clean();
        flush();
        readfile($gzPath);
        // Não apaga: fica guardado em storage/app/backups/
        exit;
    }

    private function download_via_comando_zip()
    {
        $nome    = 'clinica_estoril_completo_' . now()->format('Y-m-d_H-i-s') . '.zip';
        $caminho = $this->pasta_backups() . DIRECTORY_SEPARATOR . $nome;
        $raiz    = base_path();

        $excluir = '-x "*/vendor/*" -x "*/node_modules/*" -x "*/.git/*" -x "*/storage/app/backups/*"';
        $cmd     = 'cd ' . escapeshellarg($raiz) . ' && zip -r ' . escapeshellarg($caminho) . ' . ' . $excluir . ' 2>&1';
        exec($cmd, $output, $codigo);

        if ($codigo !== 0 || ! file_exists($caminho))
            return $this->download_fallback_sql_readme();

        $this->registar_backup('backup_sistema_completo', 'Sistema Completo (ZIP cmd)', $nome);

        return response()->download($caminho, $nome, ['Content-Type' => 'application/zip']);
    }

    private function download_fallback_sql_readme()
    {
        $nome    = 'clinica_estoril_db_' . now()->format('Y-m-d_H-i-s') . '.sql';
        $caminho = $this->pasta_backups() . DIRECTORY_SEPARATOR . $nome;
        $conteudo = $this->gerar_readme('SQL') . "\n\n" . $this->gerar_sql_completo();

        file_put_contents($caminho, $conteudo);
        $this->registar_backup('backup_banco_dados', 'Banco de Dados (fallback)', $nome);

        return response()->download($caminho, $nome, ['Content-Type' => 'application/octet-stream']);
    }

    // ═══════════════════════════════════════════════════════════
    //  LISTAGEM DOS BACKUPS GUARDADOS
    // ═══════════════════════════════════════════════════════════

    private function listar_backups_guardados(): array
    {
        $pasta   = $this->pasta_backups();
        $ficheiros = glob($pasta . DIRECTORY_SEPARATOR . '*');
        $lista   = [];

        foreach ((array) $ficheiros as $f) {
            if (! is_file($f)) continue;
            $nome = basename($f);
            if (str_starts_with($nome, 'tmp_')) continue; // ignora temporários

            $tipo = 'SQL';
            $icone = 'fa-file-code';
            $cor   = '#10b981';
            if (str_ends_with($nome, '.zip'))              { $tipo = 'ZIP';    $icone = 'fa-file-zipper'; $cor = '#0066cc'; }
            elseif (str_ends_with($nome, '.tar.gz') || str_ends_with($nome, '.gz')) { $tipo = 'TAR.GZ'; $icone = 'fa-file-archive'; $cor = '#8b5cf6'; }

            $lista[] = [
                'nome'       => $nome,
                'tipo'       => $tipo,
                'icone'      => $icone,
                'cor'        => $cor,
                'tamanho'    => $this->formatar_tamanho(filesize($f)),
                'tamanho_bytes' => filesize($f),
                'data'       => date('d/m/Y H:i', filemtime($f)),
                'timestamp'  => filemtime($f),
            ];
        }

        // Mais recentes primeiro
        usort($lista, fn($a, $b) => $b['timestamp'] - $a['timestamp']);

        return $lista;
    }

    private function formatar_tamanho(int $bytes): string
    {
        if ($bytes >= 1073741824) return round($bytes / 1073741824, 2) . ' GB';
        if ($bytes >= 1048576)   return round($bytes / 1048576, 2)   . ' MB';
        if ($bytes >= 1024)      return round($bytes / 1024, 2)      . ' KB';
        return $bytes . ' B';
    }

    // ═══════════════════════════════════════════════════════════
    //  HELPERS
    // ═══════════════════════════════════════════════════════════

    private function comando_disponivel(string $cmd): bool
    {
        if (! function_exists('exec')) return false;
        exec('which ' . escapeshellarg($cmd) . ' 2>&1', $out, $code);
        return $code === 0;
    }

    private function adicionar_pasta_ao_zip_archive(\ZipArchive $zip, string $pasta, string $raiz, array $excluirDir = []): void
    {
        $itens = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($pasta, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );
        foreach ($itens as $item) {
            $relativo = ltrim(str_replace($raiz, '', $item->getRealPath()), DIRECTORY_SEPARATOR . '/');
            foreach ($excluirDir as $dir) {
                if (str_starts_with($relativo, $dir)) continue 2;
            }
            if ($item->isFile()) {
                if ($item->getSize() > 50 * 1024 * 1024) continue;
                try { $zip->addFile($item->getRealPath(), $relativo); } catch (\Exception $e) {}
            } elseif ($item->isDir()) {
                $zip->addEmptyDir($relativo);
            }
        }
    }

    private function registar_backup(string $acao, string $descricao, string $ficheiro = ''): void
    {
        try {
            HistoricoAtividade::registar(
                'backup', $acao,
                session('nome_utilizador') . ' realizou backup: ' . $descricao . ($ficheiro ? ' → ' . $ficheiro : ''),
                ['entidade' => 'Sistema', 'id_entidade' => null, 'nome_entidade' => $descricao]
            );
        } catch (\Exception $e) {}
    }

    // ═══════════════════════════════════════════════════════════
    //  ESTATÍSTICAS
    // ═══════════════════════════════════════════════════════════

    private function obter_estatisticas(): array
    {
        $database = env('DB_DATABASE', 'clinica');
        $tabelas  = DB::select('SHOW TABLES');
        $col      = 'Tables_in_' . $database;

        $totalRegistros = 0;
        $detalheTabelas = [];

        foreach ($tabelas as $t) {
            $nome = $t->$col;
            try {
                $count = DB::table($nome)->count();
                $totalRegistros += $count;
                $detalheTabelas[] = ['tabela' => $nome, 'registros' => $count];
            } catch (\Exception $e) {
                $detalheTabelas[] = ['tabela' => $nome, 'registros' => 0];
            }
        }

        $tamanhoDb = DB::select("
            SELECT ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS mb
            FROM information_schema.tables WHERE table_schema = ?
        ", [$database])[0]->mb ?? 0;

        return [
            'total_tabelas'   => count($tabelas),
            'total_registros' => $totalRegistros,
            'tamanho_db_mb'   => $tamanhoDb,
            'tamanho_storage' => round($this->tamanho_pasta(storage_path('app/public')) / 1024 / 1024, 2),
            'versao_php'      => PHP_VERSION,
            'versao_laravel'  => app()->version(),
            'ambiente'        => app()->environment(),
            'tabelas'         => $detalheTabelas,
            'ultimo_backup'   => $this->obter_ultimo_backup(),
            'database_name'   => $database,
            'zip_disponivel'  => class_exists('ZipArchive'),
            'phar_disponivel' => class_exists('PharData'),
            'pasta_backups'   => $this->pasta_backups(),
        ];
    }

    private function gerar_sql_completo(): string
    {
        $database = env('DB_DATABASE', 'clinica');
        $tabelas  = DB::select('SHOW TABLES');
        $col      = 'Tables_in_' . $database;

        $sql  = "-- ============================================================\n";
        $sql .= "-- Clínica Estoril — Backup Completo do Banco de Dados\n";
        $sql .= "-- Data     : " . now()->format('d/m/Y H:i:s') . "\n";
        $sql .= "-- Banco    : {$database}\n";
        $sql .= "-- Gerado por: " . session('nome_utilizador', 'Administrador') . "\n";
        $sql .= "-- ============================================================\n\n";
        $sql .= "SET FOREIGN_KEY_CHECKS=0;\n";
        $sql .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
        $sql .= "SET AUTOCOMMIT = 0;\nSTART TRANSACTION;\nSET time_zone = \"+00:00\";\n\n";

        foreach ($tabelas as $t) {
            $nome = $t->$col;
            try {
                $create = DB::select("SHOW CREATE TABLE `{$nome}`");
                $sql .= "\n-- Tabela `{$nome}`\n";
                $sql .= "DROP TABLE IF EXISTS `{$nome}`;\n";
                $sql .= $create[0]->{'Create Table'} . ";\n\n";
                $linhas = DB::table($nome)->get();
                if ($linhas->count() > 0) {
                    $sql .= "-- Dados de `{$nome}`\n";
                    foreach ($linhas as $linha) {
                        $valores = array_map(function ($v) {
                            if (is_null($v))    return 'NULL';
                            if (is_numeric($v)) return $v;
                            return "'" . addslashes((string) $v) . "'";
                        }, (array) $linha);
                        $colunas = implode('`, `', array_keys((array) $linha));
                        $sql .= "INSERT INTO `{$nome}` (`{$colunas}`) VALUES (" . implode(', ', $valores) . ");\n";
                    }
                    $sql .= "\n";
                }
            } catch (\Exception $e) {
                $sql .= "-- Erro ao exportar {$nome}: " . $e->getMessage() . "\n";
            }
        }

        $sql .= "\nSET FOREIGN_KEY_CHECKS=1;\nCOMMIT;\n";
        $sql .= "-- Fim do backup — " . now()->format('d/m/Y H:i:s') . "\n";
        return $sql;
    }

    private function gerar_readme(string $formato): string
    {
        return "╔══════════════════════════════════════════════════════╗\n"
             . "║         CLÍNICA ESTORIL — BACKUP DO SISTEMA         ║\n"
             . "╚══════════════════════════════════════════════════════╝\n\n"
             . "Data do backup  : " . now()->format('d/m/Y H:i:s') . "\n"
             . "Gerado por      : " . session('nome_utilizador', 'Administrador') . "\n"
             . "Formato         : {$formato}\n"
             . "Ambiente        : " . app()->environment() . "\n"
             . "Versão Laravel  : " . app()->version() . "\n"
             . "Versão PHP      : " . PHP_VERSION . "\n\n"
             . "RESTAURAÇÃO:\n"
             . "  1. Extraia o arquivo na pasta desejada\n"
             . "  2. Copie .env.example → .env e configure as variáveis\n"
             . "  3. composer install\n"
             . "  4. php artisan key:generate\n"
             . "  5. Importe o .sql no banco de dados\n"
             . "  6. php artisan storage:link\n\n"
             . "Backup guardado em: storage/app/backups/\n"
             . "Backup gerado automaticamente pelo painel administrativo.\n";
    }

    private function tamanho_pasta(string $pasta): int
    {
        $tamanho = 0;
        if (! is_dir($pasta)) return 0;
        foreach (new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($pasta, \RecursiveDirectoryIterator::SKIP_DOTS)
        ) as $f) {
            try { $tamanho += $f->getSize(); } catch (\Exception $e) {}
        }
        return $tamanho;
    }

    private function obter_ultimo_backup(): ?string
    {
        try {
            $colunas    = Schema::getColumnListing('historico_atividades');
            $prioridade = ['created_at', 'data_hora', 'data', 'criado_em', 'timestamp'];
            $colData    = null;
            foreach ($prioridade as $c) {
                if (in_array($c, $colunas)) { $colData = $c; break; }
            }
            $query = \App\Models\HistoricoAtividade::where('acao', 'like', 'backup_%');
            if ($colData) $query->orderByDesc($colData);
            $ultimo = $query->first();
            if (! $ultimo || ! $colData) return null;
            $data = $ultimo->$colData instanceof \Carbon\Carbon
                ? $ultimo->$colData
                : \Carbon\Carbon::parse($ultimo->$colData);
            return $data->format('d/m/Y H:i');
        } catch (\Exception $e) {
            return null;
        }
    }
}
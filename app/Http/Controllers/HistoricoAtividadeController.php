<?php

namespace App\Http\Controllers;

use App\Models\HistoricoAtividade;
use App\Models\Utilizador;
use Illuminate\Http\Request;

class HistoricoAtividadeController extends Controller
{
    // ──────────────────────────────────────────────────────────
    // VERIFICAÇÃO DE ACESSO
    // ──────────────────────────────────────────────────────────
    private function verificar_admin(): bool
    {
        if (!session('id_utilizador')) return false;
        $utilizador = Utilizador::find(session('id_utilizador'));
        if (!$utilizador) return false;
        if (!$utilizador->id_admi) return false;
        if ($utilizador->nivel_acesso != 0) return false;
        return true;
    }

    // ──────────────────────────────────────────────────────────
    // VIEW PRINCIPAL
    // ──────────────────────────────────────────────────────────
    public function mostrar_historico_admin(Request $request)
    {
        if (!$this->verificar_admin()) {
            return redirect('/login');
        }

        $totalRegistos     = HistoricoAtividade::where('categoria', 'registro')->count();
        $totalConsultas    = HistoricoAtividade::where('categoria', 'consulta')->count();
        $totalAtualizacoes = HistoricoAtividade::where('categoria', 'atualizacao')->count();
        $totalPagamentos   = HistoricoAtividade::where('categoria', 'pagamento')->count();
        $totalMensagens    = HistoricoAtividade::where('categoria', 'mensagem')->count();
        $totalSessoes          = HistoricoAtividade::where('categoria', 'sessao')->count();
        $totalSessoesFalhadas   = HistoricoAtividade::where('categoria', 'sessao_falhada')->count();
        $totalLogouts          = HistoricoAtividade::where('categoria', 'logout')->count();

        return view('admin.historico_atividade', compact(
            'totalRegistos',
            'totalConsultas',
            'totalAtualizacoes',
            'totalPagamentos',
            'totalMensagens',
            'totalSessoes',
            'totalSessoesFalhadas',
            'totalLogouts'
        ));
    }

    // ──────────────────────────────────────────────────────────
    // API — LISTAGEM COM FILTROS E PAGINAÇÃO
    // ──────────────────────────────────────────────────────────
    public function api_listar_historico(Request $request)
    {
        if (!$this->verificar_admin()) {
            return response()->json(['erro' => 'Sem permissão.'], 401);
        }

        $query = HistoricoAtividade::query()->orderByDesc('criado_em');

        if ($request->filled('categoria') && $request->categoria !== 'todos') {
            $query->where('categoria', $request->categoria);
        }

        if ($request->filled('pesquisar')) {
            $termo = '%' . $request->pesquisar . '%';
            $query->where(function ($q) use ($termo) {
                $q->where('nome_util', 'like', $termo)
                  ->orWhere('descricao', 'like', $termo)
                  ->orWhere('nome_entidade', 'like', $termo)
                  ->orWhere('acao', 'like', $termo);
            });
        }

        if ($request->filled('data_inicio')) {
            $query->whereDate('criado_em', '>=', $request->data_inicio);
        }

        if ($request->filled('data_fim')) {
            $query->whereDate('criado_em', '<=', $request->data_fim);
        }

        if ($request->filled('tipo_util') && $request->tipo_util !== 'todos') {
            $query->where('tipo_util', $request->tipo_util);
        }

        $porPagina  = (int) ($request->por_pagina ?? 20);
        $paginaAtual = (int) ($request->pagina ?? 1);
        $resultados = $query->paginate($porPagina, ['*'], 'page', $paginaAtual);

        $itens = $resultados->getCollection()->map(function ($item) {
            // diffForHumans em português
            $dataCarbon = $item->criado_em;
            $relativo   = '—';
            if ($dataCarbon) {
                $relativo = $this->diff_humanos_pt($dataCarbon);
            }

            return [
                'id_historico'       => $item->id_historico,
                'id_util'            => $item->id_util,
                'nome_util'          => $item->nome_util ?? 'Sistema',
                'tipo_util'          => $item->tipo_util,
                'categoria'          => $item->categoria,
                'label_categoria'    => $item->label_categoria,
                'acao'               => $item->acao,
                'descricao'          => $item->descricao,
                'entidade'           => $item->entidade,
                'id_entidade'        => $item->id_entidade,
                'nome_entidade'      => $item->nome_entidade,
                'campos_alterados'   => $item->campos_alterados,
                'ip'                 => $item->ip,
                'icone'              => $item->icone,
                'cor'                => $item->cor,
                'criado_em'          => $dataCarbon
                    ? $dataCarbon->format('d/m/Y H:i:s')
                    : '—',
                'criado_em_relativo' => $relativo,
            ];
        });

        return response()->json([
            'data'          => $itens,
            'total'         => $resultados->total(),
            'por_pagina'    => $resultados->perPage(),
            'pagina_atual'  => $resultados->currentPage(),
            'ultima_pagina' => $resultados->lastPage(),
        ]);
    }

    // ──────────────────────────────────────────────────────────
    // LIMPAR HISTÓRICO
    // ──────────────────────────────────────────────────────────
    public function limpar_historico_admin(Request $request)
    {
        if (!$this->verificar_admin()) {
            return response()->json(['erro' => 'Sem permissão.'], 401);
        }

        HistoricoAtividade::where('criado_em', '<', now()->subDays(90))->delete();

        return response()->json(['mensagem' => 'Registos antigos removidos com sucesso.']);
    }

    // ──────────────────────────────────────────────────────────
    // HELPER — diffForHumans em Português (sem depender do locale)
    // ──────────────────────────────────────────────────────────
    private function diff_humanos_pt(\Carbon\Carbon $data): string
    {
        // Usa o timestamp absoluto para comparar — evita problemas de timezone
        $agoraTs   = now()->timestamp;
        $dataTs    = $data->timestamp;
        $segundos  = max(0, $agoraTs - $dataTs);   // diferença real em segundos
        $minutos   = (int) floor($segundos / 60);
        $horas     = (int) floor($segundos / 3600);
        $dias      = (int) floor($segundos / 86400);
        $semanas   = (int) floor($dias / 7);
        $meses     = (int) floor($dias / 30.44);
        $anos      = (int) floor($dias / 365.25);

        if ($segundos < 60)   return 'agora mesmo';
        if ($segundos < 3600) return $minutos === 1 ? '1 minuto atrás'   : "{$minutos} minutos atrás";
        if ($segundos < 86400)return $horas   === 1 ? '1 hora atrás'     : "{$horas} horas atrás";
        if ($dias     < 7)    return $dias    === 1 ? '1 dia atrás'      : "{$dias} dias atrás";
        if ($dias     < 31)   return $semanas === 1 ? '1 semana atrás'   : "{$semanas} semanas atrás";
        if ($dias     < 365)  return $meses   === 1 ? '1 mês atrás'      : "{$meses} meses atrás";
        return $anos === 1 ? '1 ano atrás' : "{$anos} anos atrás";
    }
}
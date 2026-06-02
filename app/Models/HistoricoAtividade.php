<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class HistoricoAtividade extends Model
{
    protected $table      = 'historico_atividades';
    protected $primaryKey = 'id_historico';
    public    $timestamps = false;

    protected $fillable = [
        'id_util',
        'nome_util',
        'tipo_util',
        'categoria',
        'acao',
        'descricao',
        'entidade',
        'id_entidade',
        'nome_entidade',
        'campos_alterados',
        'ip',
        'user_agent',
        'criado_em',
    ];

    protected $casts = [
        'campos_alterados' => 'array',
        'criado_em'        => 'datetime',
    ];

    // ──────────────────────────────────────────────────────────
    // MÉTODO ESTÁTICO CENTRAL — registar um evento
    // ──────────────────────────────────────────────────────────
    /**
     * Registar um evento no histórico de atividades.
     *
     * @param  string       $categoria      registro | consulta | atualizacao | pagamento
     * @param  string       $acao           ex: cadastrou_usuario, agendou_consulta
     * @param  string|null  $descricao      Texto legível para o utilizador
     * @param  array        $extra          Campos opcionais: entidade, id_entidade, nome_entidade, campos_alterados
     */
    public static function registar(
        string  $categoria,
        string  $acao,
        ?string $descricao = null,
        array   $extra     = []
    ): void {
        try {
            $idUtil   = session('id_utilizador');
            $nomeUtil = session('nome_utilizador');
            $tipoUtil = session('tipo_utilizador');

            static::create([
                'id_util'          => $idUtil,
                'nome_util'        => $nomeUtil,
                'tipo_util'        => $tipoUtil,
                'categoria'        => $categoria,
                'acao'             => $acao,
                'descricao'        => $descricao,
                'entidade'         => $extra['entidade']         ?? null,
                'id_entidade'      => $extra['id_entidade']      ?? null,
                'nome_entidade'    => $extra['nome_entidade']    ?? null,
                'campos_alterados' => $extra['campos_alterados'] ?? null,
                'ip'               => Request::ip(),
                'user_agent'       => substr(Request::userAgent() ?? '', 0, 300),
                'criado_em'        => now(),
            ]);
        } catch (\Throwable $e) {
            // Nunca deixar a auditoria quebrar a aplicação
            \Log::error('HistoricoAtividade::registar falhou: ' . $e->getMessage());
        }
    }

    // ──────────────────────────────────────────────────────────
    // HELPERS DE LEITURA
    // ──────────────────────────────────────────────────────────

    /** Ícone FontAwesome conforme categoria */
    public function getIconeAttribute(): string
    {
        return match($this->categoria) {
            'registro'     => 'fa-solid fa-user-plus',
            'consulta'     => 'fa-solid fa-stethoscope',
            'atualizacao'  => 'fa-solid fa-pen-to-square',
            'pagamento'    => 'fa-solid fa-credit-card',
            default        => 'fa-solid fa-circle-info',
        };
    }

    /** Cor CSS conforme categoria */
    public function getCorAttribute(): string
    {
        return match($this->categoria) {
            'registro'    => '#3b82f6',
            'consulta'    => '#8b5cf6',
            'atualizacao' => '#f59e0b',
            'pagamento'   => '#10b981',
            default       => '#6b7280',
        };
    }

    /** Label legível para a categoria */
    public function getLabelCategoriaAttribute(): string
    {
        return match($this->categoria) {
            'registro'    => 'Registo',
            'consulta'    => 'Consulta',
            'atualizacao' => 'Atualização',
            'pagamento'   => 'Pagamento',
            default       => ucfirst($this->categoria),
        };
    }
}
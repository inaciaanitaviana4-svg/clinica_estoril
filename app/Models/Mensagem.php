<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    protected $table      = 'mensagens';
    protected $primaryKey = 'id_mensagem';

    protected $fillable = [
        'id_consulta',
        'id_remetente',
        'id_destinatario',
        'conteudo',
        'lida',
        'lida_em',
    ];

    protected $casts = [
        'lida'    => 'boolean',
        'lida_em' => 'datetime',
    ];

    // ── Relações ──────────────────────────────────────────────

    public function consulta()
    {
        return $this->belongsTo(Consulta::class, 'id_consulta', 'id_consulta');
    }

    public function remetente()
    {
        return $this->belongsTo(Utilizador::class, 'id_remetente', 'id_util');
    }

    public function destinatario()
    {
        return $this->belongsTo(Utilizador::class, 'id_destinatario', 'id_util');
    }

    // ── Scopes ────────────────────────────────────────────────

    /** Mensagens de uma conversa (consulta + dois utilizadores) */
    public function scopeConversa($query, int $idConsulta, int $idUtilA, int $idUtilB)
    {
        return $query->where('id_consulta', $idConsulta)
            ->where(function ($q) use ($idUtilA, $idUtilB) {
                $q->where(function ($q2) use ($idUtilA, $idUtilB) {
                    $q2->where('id_remetente', $idUtilA)
                       ->where('id_destinatario', $idUtilB);
                })->orWhere(function ($q2) use ($idUtilA, $idUtilB) {
                    $q2->where('id_remetente', $idUtilB)
                       ->where('id_destinatario', $idUtilA);
                });
            });
    }

    /** Não lidas para um utilizador */
    public function scopeNaoLidas($query, int $idUtil)
    {
        return $query->where('id_destinatario', $idUtil)->where('lida', false);
    }
}
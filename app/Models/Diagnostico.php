<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Diagnostico - Diagnóstico registado numa consulta
 * Associa uma descrição de diagnóstico à consulta
 */
class Diagnostico extends Model
{
    // Define o nome da tabela
    protected $table = "diagnosticos";

    // Define a chave primária customizada
    protected $primaryKey = "id_diagnostico";

    // Desativa timestamps automáticos
    public $timestamps = false;

    // Define colunas editáveis
    protected $fillable = [
        "id",                  // Chave primária
        "id_consulta",         // FK: consulta associada
        "descricao",           // Descrição do diagnóstico
        "criado_em",           // Data/hora de criação (nullable)
        "actualizado_em",      // Data/hora de atualização (nullable)
    ];

    /**
     * Relacionamento: Um diagnóstico pertence a uma consulta
     */
    public function consulta()
    {
        return $this->belongsTo(Consulta::class, 'id_consulta', 'id_consulta');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Receita - Receita médica associada a uma consulta
 * Pode conter vários itens (medicamentos)
 */
class Receita extends Model
{
    // Define o nome da tabela
    protected $table = "receitas";

    // Define a chave primária customizada
    protected $primaryKey = "id_receita";

    // Desativa timestamps automáticos
    public $timestamps = false;

    // Define colunas editáveis
    protected $fillable = [
        "id_consulta",         // FK: consulta associada
        "observacoes",         // Observações da receita (nullable)
        "criado_em",           // Data/hora de criação (nullable)
        "actualizado_em",      // Data/hora de atualização (nullable)
    ];

    /**
     * Relacionamento: Uma receita pertence a uma consulta
     */
    public function consulta()
    {
        return $this->belongsTo(Consulta::class, 'id_consulta', 'id_consulta');
    }

    /**
     * Relacionamento: Uma receita tem vários itens (medicamentos)
     */
    public function itens()
    {
        return $this->hasMany(ReceitaItem::class, 'id_receita');
    }
}

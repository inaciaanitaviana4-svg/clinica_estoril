<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model ReceitaItem - Item (medicamento) de uma receita
 * Regista medicamento, dosagem, frequência e duração
 */
class ReceitaItem extends Model
{
    // Define o nome da tabela
    protected $table = "receitas_itens";

    // Define a chave primária customizada
    protected $primaryKey = "id_receita_item";

    // Desativa timestamps automáticos
    public $timestamps = false;

    // Define colunas editáveis
    protected $fillable = [
        "id_receita",          // FK: receita a que pertence
        "medicamento",         // Nome do medicamento
        "dosagem",             // Dosagem (nullable)
        "frequencia",          // Frequência de toma (nullable)
        "duracao",             // Duração do tratamento (nullable)
    ];

    /**
     * Relacionamento: Um item pertence a uma receita
     */
    public function receita()
    {
        return $this->belongsTo(Receita::class, 'id_receita');
    }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model ItemPagamento - Itens individuais dentro de um pagamento
 * Cada pagamento pode conter múltiplos serviços/itens
 * Registra quantidade, valor unitário e total de cada item
 */
class ItemPagamento extends Model
{
    // Define a chave primária customizada
    protected $primaryKey = "id_item_pagamento";
    
    // Define o nome da tabela
    protected $table = "items_pagamentos";

    // Desativa timestamps automáticos
    public $timestamps = false;
    
    // Define colunas editáveis
    protected $fillable = [
        "id_pagamento",         // FK: associa ao pagamento pai
        "id_servico_clinico",   // FK: serviço clínico cobrado
        "quantidade",           // Quantidade do serviço
        "valor",                // Valor unitário
        "total",                // Total (quantidade × valor)
    ];

    /**
     * Relacionamento: Um item pertence a um pagamento
     */
    public function pagamento()
    {
        return $this->belongsTo(Pagamento::class, 'id_pagamento');
    }
}

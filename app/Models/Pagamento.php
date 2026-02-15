<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Pagamento - Registra pagamentos de consultas e serviços
 * Contém relacionamentos com itens de pagamento e método de pagamento
 * Rastreia o estado do pagamento (pendente, pago, cancelado)
 */
class Pagamento extends Model
{
    // Define a chave primária customizada
    protected $primaryKey = "id_pagamento";
    
    // Define o nome da tabela
    protected $table = "pagamentos";

    // Desativa timestamps automáticos
    public $timestamps = false;
    
    // Define colunas editáveis
    protected $fillable = [
        "total_pago",           // Valor total pago
        "id_paciente",          // FK: paciente que faz o pagamento
        "id_recepcionista",     // FK: recepcionista que registrou
        "id_consulta",          // FK: consulta relacionada
        "id_metodo_pagamento",  // FK: método de pagamento utilizado
        "data",                 // Data do pagamento
        "estado",               // Estado (pendente, pago, cancelado)
    ];

    /**
     * Relacionamento: Um pagamento pode ter múltiplos itens
     */
    public function itens()
    {
        return $this->hasMany(ItemPagamento::class, 'id_pagamento');
    }

    /**
     * Relacionamento: Um pagamento pertence a um método de pagamento
     */
    public function metodo()
    {
        return $this->belongsTo(MetodoPagamento::class, 'id_metodo_pagamento');
    }

}

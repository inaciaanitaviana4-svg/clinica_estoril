<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model MetodoPagamento - Define métodos de pagamento disponíveis
 * Exemplos: Dinheiro, Cartão de Crédito, Transferência, etc
 */
class MetodoPagamento extends Model
{
    // Define a chave primária customizada
    protected $primaryKey = "id_metodo_pagamento";
    
    // Define o nome da tabela
    protected $table = "metodos_pagamentos";

    // Desativa timestamps automáticos
    public $timestamps = false;
    
    // Define colunas editáveis
    protected $fillable = [
        "nome",                 // Nome do método (ex: Cartão de Crédito)
    ];

    /**
     * Relacionamento: Um método pode estar em múltiplos pagamentos
     */
    public function pagamentos()
    {
        return $this->hasMany(Pagamento::class, 'id_metodo_pagamento');
    }
}


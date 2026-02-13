<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPagamento extends Model
{
    protected $primaryKey = "id_item_pagamento";
    protected $table = "items_pagamentos";

    public $timestamps = false;
    protected $fillable = [
        "id_pagamento",
        "id_servico_clinico",
        "quantidade",
        "valor",
        "total",
    ];

    public function pagamento()
    {
        return $this->belongsTo(Pagamento::class, 'id_pagamento');
    }
}

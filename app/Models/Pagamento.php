<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $primaryKey = "id_pagamento";
    protected $table = "pagamentos";

    public $timestamps = false; 
    protected $fillable = [
        "total_pago",
        "id_paciente",
        "id_recepcionista",
        "id_consulta",
        "id_metodo_pagamento",
        "data",
        "estado",
    ];

    public function itens()
    {
        return $this->hasMany(ItemPagamento::class, 'id_pagamento');
    }

    public function metodo()
    {
        return $this->belongsTo(MetodoPagamento::class, 'id_metodo_pagamento');
    }
}

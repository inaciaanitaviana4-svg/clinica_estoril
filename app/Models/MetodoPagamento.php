<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodoPagamento extends Model
{
    protected $primaryKey = "id_metodo_pagamento";
    protected $table = "metodos_pagamentos";

    public $timestamps = false;
    protected $fillable = [
        "nome",
    ];

    public function pagamentos()
    {
        return $this->hasMany(Pagamento::class, 'id_metodo_pagamento');
    }
}

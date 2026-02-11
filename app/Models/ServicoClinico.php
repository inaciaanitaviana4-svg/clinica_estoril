<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ServicoClinico extends Model
{
    protected $primaryKey = "id_servico_clinico";
    protected $table = "servicos_clinicos";
    public $timestamps = false;
    protected $fillable = [
        "nome",
        "id_tipo_consulta",
        "duracao_min",
        "preco",
        "activo",

    ];
    


}

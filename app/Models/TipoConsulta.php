<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TipoConsulta extends Model
{
    protected $primaryKey = "id_tipo_consulta";
    protected $table = "tipos_consultas";
    public $timestamps = false;
    protected $fillable = [
        "nome",
    ];


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $primaryKey = "id_consulta";
    protected $table = "consultas";

    public $timestamps = false;
    protected $fillable = [
        "id_medico",
        "id_paciente",
        "id_tipo_consulta",
        "id_servico_clinico",
        "data",
        "hora",
        "estado",
        "observacao",
        "modalidade",
        "id_recepcionista",

    ];
}

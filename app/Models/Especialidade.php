<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    protected $primaryKey = "id_espec";

    protected $table="especialidades";
        protected $fillable = [
        "nome",
        "descricao",
        "activo",
        

        ];
}

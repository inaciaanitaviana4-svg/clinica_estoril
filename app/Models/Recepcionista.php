<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class recepcionista extends Model
{
protected $primaryKey = "id_recepcionista";
	protected $table = "recepcionista";
	
    public $timestamps = false;
        protected $fillable = [
        "morada",
        "num_telefone",
        "senha",
        "nome",
        "genero",
        "email",
        "id_clinica",
        ];
     
       
}

<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
protected $primaryKey = "id_medico";
	protected $table = "medico";
    
    public $timestamps = false;
	
        protected $fillable = [
        "morada",
        "num_telefone",
        "senha",
        "nome",
        "genero",
        "email",
        "especialiadade",
        "ano_experiencia",
        "id_clinica",
        ];
     
       
}

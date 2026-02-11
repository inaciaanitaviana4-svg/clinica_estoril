<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
protected $primaryKey = "id_paciente";
	protected $table = "paciente";
    
    public $timestamps = false;
	
        protected $fillable = [
        "morada",
        "num_telefone",
        "senha",
        "nome",
        "genero",
        "email",
        "data_nascimento",
        "num_bi",
        "estado_civil",
        "cidade",
        "bairro",
        "seguro",
        "id_clinica",

        ];
     
       
}

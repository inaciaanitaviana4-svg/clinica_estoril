<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Utilizador extends Model
{
    protected $primaryKey = "id_util";

	protected $table = "utilizadores";
	
    public $timestamps = false;
	
    
         protected $fillable = [
        "num_telefone",
        "senha",
        "nome",
        "genero",
        "email",
        "nivel_acesso",
        "id_admi",
        "id_medico",
        "id_recepcionista",
        "id_paciente",

        ];
       
}

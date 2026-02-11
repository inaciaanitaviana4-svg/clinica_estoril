<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Admi extends Model
{
protected $primaryKey = "id_admi";
	protected $table = "administradores";
    public $timestamps = false;
    protected $fillable = [
        "morada",
        "num_telefone",
        "senha",
        "nome",
        "genero",
        "email",
        ];
     
       
}

<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Clinica extends Model
{
protected $primaryKey = "id_clinica";
	protected $table = "clinica";
    
    public $timestamps = false;
	
        protected $fillable = [
        "nif",
        "localizacacao",
        "nome",
        "id_admi",
      
        ];
     
       
}

<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Model TipoConsulta - Categorização de tipos de consulta
 * Define tipos como: Presencial, Telemedicina, Primeira Consulta, etc
 */
class TipoConsulta extends Model
{
    // Define a chave primária customizada
    protected $primaryKey = "id_tipo_consulta";
    
    // Define o nome da tabela
    protected $table = "tipos_consultas";
    
    // Desativa timestamps automáticos
    public $timestamps = false;
    
    // Define colunas editáveis
    protected $fillable = [
        "nome",                 // Nome do tipo de consulta
    ];
}


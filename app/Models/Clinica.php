<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Clinica - Representa uma unidade clínica no sistema
 * Cada clínica tem próprios médicos, pacientes, consultas e serviços
 */
class Clinica extends Model
{
    // Define a chave primária customizada
    protected $primaryKey = "id_clinica";
    
    // Define o nome da tabela
    protected $table = "clinica";
    
    // Desativa timestamps automáticos
    public $timestamps = false;
    
    // Define colunas editáveis
    protected $fillable = [
        "nif",                  // Número de Identificação Fiscal
        "localizacao",          // Localização/endereço da clínica
        "nome",                 // Nome da clínica
        "id_admi",              // FK: administrador responsável
    ];
}


<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Paciente - Representa um paciente do sistema
 * Contém dados pessoais, endereço e informações de saúde
 * Cada paciente está associado a uma clínica
 */
class Paciente extends Model
{
    // Define a chave primária customizada
    protected $primaryKey = "id_paciente";
    
    // Define o nome da tabela no banco de dados
    protected $table = "paciente";
    
    // Desativa timestamps automáticos
    public $timestamps = false;
    
    // Define colunas editáveis
    protected $fillable = [
        "morada",               // Endereço completo
        "num_telefone",         // Telefone para contato
        "senha",                // Senha (com hash)
        "nome",                 // Nome completo
        "genero",               // Gênero (M ou F)
        "email",                // Email para comunicação
        "data_nascimento",      // Data de nascimento
        "num_bi",               // Número do BI (documento de identidade)
        "estado_civil",         // Estado civil (solteiro, casado, etc)
        "cidade",               // Cidade de residência
        "bairro",               // Bairro de residência
        "seguro",               // Informações do seguro de saúde
        "id_clinica",           // FK: relacionamento com clínica
    ];
}


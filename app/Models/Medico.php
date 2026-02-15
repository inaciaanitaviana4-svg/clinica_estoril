<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Medico - Representa um profissional médico do sistema
 * Contém qualificações profissionais como especialidade e experiência
 * Está associado a uma clínica específica
 */
class Medico extends Model
{
    // Define a chave primária customizada
    protected $primaryKey = "id_medico";
    
    // Define o nome da tabela no banco de dados
    protected $table = "medico";
    
    // Desativa timestamps automáticos
    public $timestamps = false;
    
    // Define colunas editáveis
    protected $fillable = [
        "morada",               // Endereço completo
        "num_telefone",         // Telefone para contato
        "senha",                // Senha (com hash)
        "nome",                 // Nome completo
        "genero",               // Gênero (M ou F)
        "email",                // Email profissional
        "especialidade",        // Área de especialização (cardiologia, pediatria, etc)
        "ano_experiencia",      // Anos de experiência profissional
        "id_clinica",           // FK: relacionamento com clínica
    ];
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Recepcionista - Representa um recepcionista da clínica
 * Responsável por agendar consultas e gerenciar pacientes
 * Está associado a uma clínica específica
 */
class recepcionista extends Model
{
    // Define a chave primária customizada
    protected $primaryKey = "id_recepcionista";
    
    // Define o nome da tabela
    protected $table = "recepcionista";

    // Desativa timestamps automáticos
    public $timestamps = false;
    
    // Define colunas editáveis
    protected $fillable = [
        "morada",               // Endereço
        "num_telefone",         // Telefone
        "senha",                // Senha (com hash)
        "nome",                 // Nome completo
        "genero",               // Gênero (M ou F)
        "email",                // Email
        "id_clinica",           // FK: clínica onde trabalha
    ];
}

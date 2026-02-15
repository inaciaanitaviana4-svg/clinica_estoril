<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Horario - Define horários disponíveis dos médicos
 * Cada médico pode ter múltiplos horários para consultas
 */
class Horario extends Model
{
    // Define a chave primária customizada (note: há typo "id_horaro" em vez de "id_horario")
    protected $primaryKey = "id_horaro";
    
    // Desativa timestamps automáticos
    public $timestamps = false;

    // Define o nome da tabela
    protected $table = "horarios";
    
    // Define colunas editáveis
    protected $fillable = [
        "hora",                 // Horário disponível (ex: 10:00, 14:30)
        "activo",               // Status ativo/inativo
        "id_medico",            // FK: associa o horário ao médico
    ];
}


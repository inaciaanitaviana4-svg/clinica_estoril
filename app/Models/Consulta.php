<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Consulta - Representa uma consulta médica agendada
 * Liga um paciente a um médico em uma data/hora específica
 * Rastreia estado da consulta e observações
 */
class Consulta extends Model
{
    // Define a chave primária customizada
    protected $primaryKey = "id_consulta";
    
    // Define o nome da tabela
    protected $table = "consultas";

    // Desativa timestamps automáticos
    public $timestamps = false;
    
    // Define colunas editáveis
    protected $fillable = [
        "id_medico",            // FK: aponta para o médico da consulta
        "id_paciente",          // FK: aponta para o paciente
        "id_tipo_consulta",     // FK: tipo de consulta (presencial, online, etc)
        "id_servico_clinico",   // FK: serviço clínico (raio-x, análise, etc)
        "data",                 // Data da consulta
        "hora",                 // Hora da consulta
        "estado",               // Estado (agendada, confirmada, realizada, cancelada)
        "observacao",           // Observações do médico
        "modalidade",           // Modalidade (presencial, telemedicina, etc)
        "id_recepcionista",     // FK: recepcionista que agendou
    ];
}


<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Model ServicoClinico - Define serviços oferecidos pela clínica
 * Cada serviço tem duração, preço e está associado a um tipo de consulta
 * Exemplos: "Consulta Geral", "Raio-X", "Análise de Sangue"
 */
class ServicoClinico extends Model
{
    // Define a chave primária customizada
    protected $primaryKey = "id_servico_clinico";
    
    // Define o nome da tabela
    protected $table = "servicos_clinicos";
    
    // Desativa timestamps automáticos
    public $timestamps = false;
    
    // Define colunas editáveis
    protected $fillable = [
        "nome",                 // Nome do serviço (ex: Consulta Geral)
        "id_tipo_consulta",     // FK: tipo de consulta associado
        "duracao_min",          // Duração em minutos
        "preco",                // Preço do serviço
        "activo",               // Status ativo/inativo
    ];
}


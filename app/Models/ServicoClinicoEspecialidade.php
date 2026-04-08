<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model ServicoClinico - Define serviços oferecidos pela clínica
 * Cada serviço tem duração, preço e está associado a um tipo de consulta
 * Exemplos: "Consulta Geral", "Raio-X", "Análise de Sangue"
 */
class ServicoClinicoEspecialidade extends Model
{
    // Define o nome da tabela
    protected $table = 'servicos_clinicos_especialidades';

    // Desativa timestamps automáticos
    public $timestamps = false;

    // Define colunas editáveis
    protected $fillable = [
        'id_servico_clinico',
        'id_especialidade',
    ];
}

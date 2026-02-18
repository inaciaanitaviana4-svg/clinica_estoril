<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Triagem - Dados de triagem de uma consulta
 * Regista queixa principal, sinais vitais e observações da triagem
 */
class Triagem extends Model
{
    // Define o nome da tabela
    protected $table = "triagens";

    // Define a chave primária customizada
    protected $primaryKey = "id_triagem";

    // Desativa timestamps automáticos
    public $timestamps = false;

    // Define colunas editáveis
    protected $fillable = [
        "id_consulta",         // FK: consulta associada
        "id_enfermeiro",        // FK: enfermeiro que realizou a triagem (nullable)
        "queixa_principal",     // Queixa principal do paciente
        "temperatura",          // Temperatura em °C (nullable)
        "pressao_arterial",     // Pressão arterial ex: 120/80 (nullable)
        "frequencia_cardiaca",  // Frequência cardíaca (nullable)
        "saturacao_oxigenio",  // Saturação de oxigénio % (nullable)
        "nivel_dor",           // Nível de dor 0-10 (nullable)
        "observacoes",         // Observações da triagem (nullable)
    ];

    /**
     * Relacionamento: Uma triagem pertence a uma consulta
     */
    public function consulta()
    {
        return $this->belongsTo(Consulta::class, 'id_consulta', 'id_consulta');
    }
}

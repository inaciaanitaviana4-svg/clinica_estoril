<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model ExameSolicitado - Exame clínico solicitado numa consulta
 * Associa um serviço clínico à consulta com resultado e estado
 */
class ExameSolicitado extends Model
{
    // Define o nome da tabela
    protected $table = "exames_solicitados";

    // Define a chave primária customizada
    protected $primaryKey = "id_exame_solicitado";

    // Desativa timestamps automáticos
    public $timestamps = false;

    // Define colunas editáveis
    protected $fillable = [
        "id_consulta",           // FK: consulta associada
        "id_servico_clinico",    // FK: serviço clínico (exame)
        "resultado",             // Resultado do exame (nullable)
        "observacoes",           // Observações (nullable)
        "status",                // PENDENTE | REALIZADO
        "criado_em",             // Data/hora de criação (nullable)
        "actualizado_em",        // Data/hora de atualização (nullable)
    ];

    /**
     * Relacionamento: Um exame solicitado pertence a uma consulta
     */
    public function consulta()
    {
        return $this->belongsTo(Consulta::class, 'id_consulta', 'id_consulta');
    }

    /**
     * Relacionamento: Um exame solicitado pertence a um serviço clínico
     */
    public function servicoClinico()
    {
        return $this->belongsTo(ServicoClinico::class, 'id_servico_clinico', 'id_servico_clinico');
    }
}

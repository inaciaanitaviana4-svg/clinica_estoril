<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Utilizador - Representa um usuário autenticado no sistema
 * Cada utilizador tem um nível de acesso (admin, médico, recepcionista ou paciente)
 * e pode estar associado a uma entidade específica (Admi, Medico, Recepcionista, Paciente)
 */
class Utilizador extends Model
{
    // Define a chave primária customizada
    protected $primaryKey = "id_util";

    // Define o nome da tabela no banco de dados
    protected $table = "utilizadores";
    
    // Desativa timestamps automáticos (created_at, updated_at)
    public $timestamps = false;
    
    // Define quais colunas podem ser preenchidas em mass assignment
    protected $fillable = [
        "num_telefone",     // Número de telefone do utilizador
        "senha",            // Senha (deve estar com hash)
        "nome",             // Nome completo
        "genero",           // Gênero (M ou F)
        "email",            // Email único para autenticação
        "nivel_acesso",     // 0=admin, 1=recepcionista, 2=médico, 3=paciente
        "id_admi",          // FK: relacionamento com tabela admis
        "id_medico",        // FK: relacionamento com tabela medicos
        "id_recepcionista", // FK: relacionamento com tabela recepcionistas
        "id_paciente",      // FK: relacionamento com tabela pacientes
    ];
}


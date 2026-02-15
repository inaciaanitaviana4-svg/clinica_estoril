<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Especialidade - Categorias de especialidades médicas
 * Define especialidades como cardiologia, pediatria, etc
 * Usada ao registrar médicos com suas áreas
 */
class Especialidade extends Model
{
    // Define a chave primária customizada
    protected $primaryKey = "id_espec";

    // Define o nome da tabela
    protected $table = "especialidades";
    
    // Define colunas editáveis
    protected $fillable = [
        "nome",                 // Nome da especialidade (ex: Cardiologia)
        "descricao",            // Descrição da especialidade
        "activo",               // Status ativo/inativo
    ];
}


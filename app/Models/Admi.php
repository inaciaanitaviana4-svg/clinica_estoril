<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Admi - Representa um administrador do sistema
 * Administradores têm acesso total ao sistema e gerenciam usuários
 */
class Admi extends Model
{
    // Define a chave primária customizada
    protected $primaryKey = "id_admi";
    
    // Define o nome da tabela
    protected $table = "administradores";
    
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
    ];
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Notificacao - Envia notificações aos utilizadores
 * Rastreia notificações lidas e não lidas por usuário
 * Pode ser sobre consultas, pagamentos, mensagens do sistema, etc
 */
class Notificacao extends Model
{
    // Define a chave primária customizada
    protected $primaryKey = "id_notificacao";
    
    // Desativa timestamps automáticos
    public $timestamps = false;

    // Define o nome da tabela
    protected $table = "notificacoes";
    
    // Define colunas editáveis
    protected $fillable = [
        "titulo",               // Título da notificação
        "mensagem",             // Conteúdo da notificação
        "id_util",              // FK: utilizador que recebe a notificação
        "lida",                 // Flag: 0=não lida, 1=lida
        "data",                 // Data/hora da notificação
    ];
}

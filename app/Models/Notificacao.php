<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    protected $primaryKey = "id_notificacao";
    public $timestamps = false;

    protected $table = "notificacoes";
    protected $fillable = [
        "titulo",
        "mensagem",
        "id_util",
        "lida",
        "data",


    ];
}

<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class configuracao extends Model
{
       protected $table = "configuracoes";
       protected $fillable = [
        "ano_fundacao",
    ];
}


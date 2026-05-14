<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table = 'password_resets';
    
    protected $fillable = [
        'email', 'token', 'codigo_verificacao', 'reset_token', 'expires_at'
    ];
    
    protected $casts = [
        'expires_at' => 'datetime',
        'created_at' => 'datetime'
    ];
}
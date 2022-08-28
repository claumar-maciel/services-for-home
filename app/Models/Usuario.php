<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'senha',
        'nome',
        'cpf',
        'username',
        'endereco_id',
        'contato_id',
        'perfil_id',
    ];
}

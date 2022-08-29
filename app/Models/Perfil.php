<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    const ADMINISTRADOR = 1;
    const CLIENTE = 2;
    const PRESTADOR = 3;

    protected $fillable = [
        'id',
        'descricao'
    ];
}

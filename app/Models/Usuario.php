<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'nome',
        'cpf',
        'username',
        'endereco_id',
        'contato_id',
        'perfil_id'
    ];

    protected $hidden = [
        'password'
    ];

    public function contato()
    {
        return $this->belongsTo(Contato::class);
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    public function clientChats()
    {
        return $this->hasMany(Chat::class, 'client_id', 'id');
    }

    public function providerChats()
    {
        return $this->hasMany(Chat::class, 'provider_id', 'id');
    }

    static function search(array $filters = []): Builder {
        /** @var Builder $query */
        $usuarios = self::query();

        $search = isset($filters['search']) ? $filters['search'] : null;
        if($search) {
            $usuarios->where(function($query) use ($search) {
                $query->where('email', 'like', "%$search%")
                        ->orWhere('nome', 'like', "%$search%")
                        ->orWhere('cpf', 'like', "%$search%")
                        ->orWhere('username', 'like', "%$search%");
            });
        }

        return $usuarios;
    }
}

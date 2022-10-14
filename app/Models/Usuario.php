<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
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

    static function search(array $filters = []) {
        /** @var Builder $query */
        $usuarios = self::query();

        if (auth()->user()->endereco->latitude) {
            $latitude = auth()->user()->endereco->latitude;
            $longitude = auth()->user()->endereco->longitude;

            $usuarios->join('enderecos', 'usuarios.endereco_id', '=', 'enderecos.id');
            $usuarios->selectRaw("usuarios.*,
                enderecos.id,
                enderecos.latitude,
                enderecos.longitude,
                ( 3959 * acos(cos(radians($latitude)) 
                        * cos(radians(enderecos.latitude )) 
                        * cos(radians(enderecos.longitude) - radians($longitude) ) 
                        + sin(radians($latitude)) 
                        * sin(radians(enderecos.latitude)))) AS distancia"
            );

            $usuarios->orderByRaw("CASE WHEN distancia IS NULL THEN 1 ELSE 0 END, distancia");
        }

        $search = isset($filters['search']) ? $filters['search'] : null;
        if($search) {
            $usuarios->where(function($query) use ($search) {
                $query->where('usuarios.email', 'like', "%$search%")
                        ->orWhere('usuarios.nome', 'like', "%$search%")
                        ->orWhere('usuarios.cpf', 'like', "%$search%")
                        ->orWhere('usuarios.username', 'like', "%$search%");
            });
        }

        return $usuarios;
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_usuario', 'usuario_id', 'service_id');
    }
}

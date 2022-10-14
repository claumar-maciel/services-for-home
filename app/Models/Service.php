<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'description'
    ];

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'service_usuario', 'usuario_id', 'service_id');
    }

    static function search(array $filters = []) {
        /** @var Builder $query */
        $services = self::query();

        $search = isset($filters['search']) ? $filters['search'] : null;
        if($search) {
            $services->where(function($query) use ($search) {
                $query->where('description', 'like', "%$search%");
            });
        }

        return $services;
    }
}

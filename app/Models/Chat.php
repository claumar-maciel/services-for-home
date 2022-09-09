<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'provider_id',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function client()
    {
        return $this->belongsTo(Usuario::class, 'client_id', 'id');
    }

    public function provider()
    {
        return $this->belongsTo(Usuario::class, 'provider_id', 'id');
    }
}

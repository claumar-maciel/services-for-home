<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheduling extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'scheduling_status_id',
        'client_id',
        'provider_id',
        'chat_id',
        'start_event',
        'end_event',
        'rating',
        'client_comment'
    ];

    public function client()
    {
        return $this->belongsTo(Usuario::class, 'client_id', 'id');
    }

    public function provider()
    {
        return $this->belongsTo(Usuario::class, 'provider_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(SchedulingStatus::class, 'scheduling_status_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(SchedulingImage::class, 'scheduling_id', 'id');
    }
}

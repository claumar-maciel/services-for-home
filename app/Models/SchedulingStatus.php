<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchedulingStatus extends Model
{
    use HasFactory;

    const CREATED = 1;
    const ACCEPTED = 2;
    const IN_PROGRESS = 3;
    const FINISHED = 4;

    public $timestamps = false;
    protected $fillable = [
        'id',
        'description'
    ];
}

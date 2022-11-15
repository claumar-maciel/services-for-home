<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchedulingImage extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['url', 'scheduling_id'];
}

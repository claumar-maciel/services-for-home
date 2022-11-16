<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'banner'];

    static function search(array $filters = []) {
        /** @var Builder $query */
        $posts = self::query();

        $search = isset($filters['search']) ? $filters['search'] : null;

        if($search) {
            $posts->where('title', 'like', "%$search%");
        }

        return $posts;
    }
}

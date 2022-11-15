<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'answer'];

    static function search(array $filters = []) {
        /** @var Builder $query */
        $faqs = self::query();

        $search = isset($filters['search']) ? $filters['search'] : null;

        if($search) {
            $faqs->where(function($query) use ($search) {
                $query->where('question', 'like', "%$search%")
                        ->where('answer', 'like', "%$search%");
            });
        }

        return $faqs;
    }

}

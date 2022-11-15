<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class StoreRatingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'rating' => 'required|integer|min:1|max:5',
            'client_comment' => 'nullable|string|min:3|max:255',
            'images' => 'nullable|array',
            'images.*' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
        ];
    }

    public function attributes(): array
    {
        return [
            'rating' => 'avaliação',
            'client_comment' => 'comentário',
            'images' => 'imagem',
        ];
    }
}

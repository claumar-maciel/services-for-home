<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3',
            'content' => 'required|string|min:3',
            'banner' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'título',
            'content' => 'conteúdo',
        ];
    }
}

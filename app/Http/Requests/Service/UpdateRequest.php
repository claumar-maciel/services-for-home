<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'description' => 'required|min:5|max:255'
        ];
    }
}

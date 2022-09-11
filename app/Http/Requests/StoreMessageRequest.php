<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => 'required|min:5'
        ];
    }


    public function attributes()
    {
        return [
            'content' => 'conteúdo'
        ];
    }
}

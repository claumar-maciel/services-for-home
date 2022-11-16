<?php

namespace App\Http\Requests\Admin\Faq;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'question' => 'required|string|min:3',
            'answer' => 'required|string|min:3',
        ];
    }

    public function attributes(): array
    {
        return [
            'question' => 'pergunta',
            'answer' => 'resposta',
        ];
    }
}

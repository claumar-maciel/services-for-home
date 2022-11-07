<?php

namespace App\Http\Requests\Provider;

use Illuminate\Foundation\Http\FormRequest;

class StoreSchedulingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:45',
            'date' => 'required|date_format:Y-m-d',
            'hour' => 'required|date_format:H:i',
        ];
    }
}

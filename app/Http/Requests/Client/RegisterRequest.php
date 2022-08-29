<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:usuarios|max:75',
            'senha' => 'required|min:8|max:255',
            'nome' => 'required|min:2|max:45',
            'cpf' => 'required|cpf|unique:usuarios',
            'username' => 'required|min:2|max:45|unique:usuarios',

            'rua' => 'required|min:2|max:45',
            'numero' => 'required|max:10',
            'bairro' => 'required|min:2|max:45',
            'cidade' => 'required|min:2|max:45',
            'estado' => 'required|min:2|max:2',
            'cep' => 'required|formato_cep',
            'ponto_referencia' => 'required|min:2|max:45',
            'complemento' => 'nullable|min:2|max:45',

            'celular' => 'required|celular_com_ddd',
            'telefone_residencial' => 'required|telefone_com_ddd'
        ];
    }
}

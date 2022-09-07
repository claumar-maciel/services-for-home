<?php

namespace App\Http\Requests\Admin\Provider;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => "required|email|max:75|unique:usuarios,email,{$this->client->id}",
            'senha' => 'nullable|min:8|max:255',
            'nome' => 'required|min:2|max:45',
            'cpf' => "required|cpf|unique:usuarios,cpf,{$this->client->id}",
            'username' => "required|min:2|max:45|unique:usuarios,username,{$this->client->id}",

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

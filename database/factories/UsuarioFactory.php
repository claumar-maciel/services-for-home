<?php

namespace Database\Factories;

use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Perfil;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UsuarioFactory extends Factory
{
    public function definition(): array
    {
        $dadosDoContato = [
            'celular' => '55991852004', 
            'telefone_residencial' => '5591852004'
        ];
        $contato = Contato::create($dadosDoContato);
    
        $dadosDoEndereco = [
            'rua' => 'Rua México', 
            'numero' => fake()->buildingNumber(), 
            'bairro' => 'Vila Nações Unidas', 
            'cidade' => 'Itabira', 
            'estado' => 'MG', 
            'cep' => '35900055', 
            'ponto_referencia' => 'ponto de referencia', 
            'complemento' => 'complemento'
        ];
        $endereco = Endereco::create($dadosDoEndereco);

        return [
            'nome' => fake()->name(),
            'email' => fake()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'cpf' => strval(rand(11111111111, 99999999999)),
            'username' => Str::random(10),
            'endereco_id' => $endereco->id,
            'contato_id' => $contato->id
        ];
    }
}

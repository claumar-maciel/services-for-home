<?php

namespace Database\Seeders;

use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Perfil;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
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

        Usuario::create([
            'nome' => fake()->name(),
            'email' => 'admin@admin.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'cpf' => '37617709013',
            'username' => 'admin.test',
            'endereco_id' => $endereco->id,
            'contato_id' => $contato->id,
            'perfil_id' => Perfil::ADMINISTRADOR
        ]);
    }
}

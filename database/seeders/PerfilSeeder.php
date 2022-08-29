<?php

namespace Database\Seeders;

use App\Models\Perfil;
use Illuminate\Database\Seeder;

class PerfilSeeder extends Seeder
{
    public function run(): void
    {
        Perfil::create([
            'id' => Perfil::ADMINISTRADOR,
            'descricao' => 'Administrador'
        ]);

        Perfil::create([
            'id' => Perfil::CLIENTE,
            'descricao' => 'Cliente'
        ]);

        Perfil::create([
            'id' => Perfil::PRESTADOR,
            'descricao' => 'Prestador'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Perfil;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::factory()->count(50)->create([
            'perfil_id' => Perfil::CLIENTE
        ]);
    }
}

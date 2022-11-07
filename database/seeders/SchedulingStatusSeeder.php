<?php

namespace Database\Seeders;

use App\Models\SchedulingStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchedulingStatusSeeder extends Seeder
{
    public function run(): void
    {
        SchedulingStatus::create([
            'id' => SchedulingStatus::CREATED,
            'description' => 'Criado'
        ]);

        SchedulingStatus::create([
            'id' => SchedulingStatus::ACCEPTED,
            'description' => 'Aceito'
        ]);

        SchedulingStatus::create([
            'id' => SchedulingStatus::IN_PROGRESS,
            'description' => 'Em Andamento'
        ]);

        SchedulingStatus::create([
            'id' => SchedulingStatus::FINISHED,
            'description' => 'Finalizado'
        ]);
    }
}

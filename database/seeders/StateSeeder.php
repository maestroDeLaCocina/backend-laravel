<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{

    public function run(): void
    {
        State::query()->insert([
            [
                'name' => 'Por Hacer',
            ],
            [
                'name' => 'En Progreso',
            ],
            [
                'name' => 'Completada',
            ],
        ]);

    }
}

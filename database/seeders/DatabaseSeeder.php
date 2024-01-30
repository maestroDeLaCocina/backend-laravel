<?php

namespace Database\Seeders;

use App\Models\State;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(StateSeeder::class);

        User::factory(10)
        ->has(Todo::factory()
        ->count(2)
        ->state(new Sequence(
            fn($sequence)=>['state_id'=>State::all()->random()]
        )))
        ->create();
    }
}

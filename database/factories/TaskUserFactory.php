<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'active' => $this->faker->boolean(80),
            'due_date' => $this->faker->dateTime(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(4),
            'description' => $this->faker->sentence(10),
            'image' => $this->faker->imageUrl(),
            'due_date' => $this->faker->dateTime(),
        ];
    }
}

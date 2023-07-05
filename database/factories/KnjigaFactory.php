<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KnjigaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'naziv' => $this->faker->word(),
            'imeAutora' => $this->faker->title(),
            'prezimeAutora' => $this->faker->lastName(),
            'izdavac' => $this->faker->word(),
            'godinaRodjenja' => $this->faker->year($max = 'now'),
            'created_at' => now() 
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AutorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ime' => $this->faker->firstName(),
            'prezime' => $this->faker->lastName(),
            'telefon' => $this->faker->phoneNumber(),
            'adresa' => $this->faker->streetAddress(),
            'created_at' => now() 
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_file' => $this->faker->name(),
            'type' => $this->faker->name(),
            'size' => $this->faker->numberBetween($min = 1, $max = 500),
            'url' => $this->faker->file('C:/Users/hp/Documents/Images', 'public/ressources/docs'),
        ];
    }
}

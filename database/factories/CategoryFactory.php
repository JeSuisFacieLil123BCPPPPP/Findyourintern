<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //'name_cat', 'description','active',
            'name_cat' => $this->faker->name(),
            'description' => $this->faker->text(30),
            'active' => true,
        ];
    }
}

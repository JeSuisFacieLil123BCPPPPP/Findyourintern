<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name_subcat' => $this->faker->name(),
            'description' => $this->faker->text(30),
            'active' => true,
        ];
    }
}

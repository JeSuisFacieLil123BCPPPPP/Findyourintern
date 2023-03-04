<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RealisationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'title','description','nbr_vue',
            'title' => $this->faker->name(),
            'description' =>  $this->faker->paragraph(2),
            'nbr_vue' => $this->faker->numberBetween($min = 1, $max = 500),
            'valide'=> $this->faker->numberBetween($min = 0, $max = 1),
            //'school_name' =>  $this->faker->jobTitle(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
         //Student(id,firstname,lastname,pays,school_name,user_id)
        return [
            'firstname' => $this->faker->firstName(),
            'lastname' =>  $this->faker->lastName(),
            'pays' => $this->faker->country(),
            'school_name' =>  $this->faker->jobTitle(),
        ];
    }
}

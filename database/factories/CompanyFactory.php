<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\User;
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    //Company(id,company_name,pays,description,user_id)
    public function definition()
    {
        return [
            'company_name' => $this->faker->company(),
            'pays' => $this->faker->country(),
            'description' => $this->faker->text(),
        ];
    }
}

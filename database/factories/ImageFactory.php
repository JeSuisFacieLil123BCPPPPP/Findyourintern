<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //image($dir = '/tmp', $width = 640, $height = 480)
            'name_img' => $this->faker->name(),
            'size' => $this->faker->numberBetween($min = 1, $max = 500),
            'url' => $this->faker->file('C:/Users/hp/Documents/Images', 'public/ressources/images'),//image('public/images',640,480,null),
        ];
    }
}

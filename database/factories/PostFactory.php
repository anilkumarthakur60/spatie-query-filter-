<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'category_id' => $this->faker->numberBetween(1, 10000),
            'tag_id' => $this->faker->numberBetween(1, 10000),
            'brand_id' => $this->faker->numberBetween(1, 10000),
        ];
    }
}
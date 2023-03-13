<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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

            'name' => $this->faker->name(),
            'slug' => $this->faker->unique()->safeEmail(),
            'description' => $this->faker->name(),
            'status' => $this->faker->numberBetween(0, 1),
            'parent_id' => null,
        ];
    }



}
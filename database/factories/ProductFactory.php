<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model
     */
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween(1),
            'name' => $this->faker->word(),
            'slug' => $this->faker->word(),
            'image' => $this->faker->imageUrl,
            'description' => $this->faker->text(),
            'status' => $this->faker->numberBetween(0, 1),
            'unit_price' => $this->faker->randomFloat(2, 50, 5000),


        ];
    }
}
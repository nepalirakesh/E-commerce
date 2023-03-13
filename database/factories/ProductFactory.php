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
            'category_id' => 1,
            'name' => $this->faker->word(),
            'slug' => $this->faker->unique()->sentence(),
            'image' => $this->faker->imageUrl,
            'quantity' => $this->faker->numberBetween(3, 66),
            'description' => $this->faker->text(),
            'status' => $this->faker->numberBetween(0, 1),
            'unit_price' => $this->faker->randomFloat(2, 50, 5000),


        ];
    }
}
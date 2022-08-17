<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name(),
            'price' => $this->faker->randomFloat(NULL, 0, 100),
            'description' => $this->faker->realText(200,2),
            'category' => $this->faker->sentence(2, true),
            'image_url' => $this->faker->imageUrl(640,480),
        ];
    }
}

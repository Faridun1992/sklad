<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Storage;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image' => null,
            'title' => $this->faker->unique()->word,
            'category_id' => Category::all()->random()->id,
            'unit_id' => Unit::all()->random()->id,
            'code' => $this->faker->numberBetween(11111, 999999),
            'vendor_code' => $this->faker->numberBetween(2222, 543543),

        ];
    }
}

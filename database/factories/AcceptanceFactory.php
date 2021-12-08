<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

class AcceptanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => Product::all()->random()->id,
            'count' => $this->faker->numberBetween(20,100),
            'price' => $this->faker->numberBetween(1000, 1100),
            'margin' => 10,
            'selling_price' => $this->faker->numberBetween(1100, 2200),
            'storage_id' => Storage::all()->random()->id,
        ];
    }
}

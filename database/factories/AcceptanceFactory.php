<?php

namespace Database\Factories;

use App\Models\Product;
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
            'count' => $this->faker->randomDigitNotNull,
            'price' => $this->faker->randomDigitNotNull,
            'margin' => 10,
        ];
    }
}

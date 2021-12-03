<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Worker::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber,
            'role_id' => Role::all()->random()->id,
            'status' => $this->faker->boolean,
            'created_at' => $this->faker->dateTimeBetween('-2 years', now()),
        ];
    }
}

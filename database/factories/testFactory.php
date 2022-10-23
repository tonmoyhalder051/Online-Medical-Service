<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\test;
use Illuminate\Database\Eloquent\Factories\Factory;

class testFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = test::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hospital_id' => $this->faker->randomDigit,
            'service_type' => $this->faker->randomElement(['0','1']),
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'price' =>$this->faker->numberBetween(100,5000),
            'discount' => $this->faker->numberBetween(0,30),
            'active'=>0,
        ];
    }
}

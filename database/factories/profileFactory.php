<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class profileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomNumber(2,false),
            'hospital_id' => $this->faker->randomDigit,
            'blood_group' => $this->faker->randomElement(['A+','B+','O+','AB+','A-','B-','O-','AB-']),
            'address' => $this->faker->address.' '.$this->faker->country,
            'gender' => $this->faker->name,
            'mobile' => $this->faker->phoneNumber,
        ];
    }
}

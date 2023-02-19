<?php

namespace Database\Factories;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

class carFactory extends Factory
{
    protected $faker;

    public function definition(): array
    {
        $faker = app(Generator::class);

        return [
            'year_of_release' =>  $faker->numberBetween(2000, 2023),
            'state_number' =>  $faker->regexify('/[A-W]{1}\d{3}[A-W]{2}\d{3}/'),
            'brand_id' => $faker->numberBetween(1, 30),
            'color_id' => $faker->numberBetween(1, 20),
            'client_id' => $faker->numberBetween(1, 30),

        ];
    }
}

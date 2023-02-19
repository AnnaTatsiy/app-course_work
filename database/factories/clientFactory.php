<?php

namespace Database\Factories;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

class clientFactory extends Factory
{
    protected $faker;

    public function definition(): array
    {
        $faker = app(Generator::class);

        return [
            'passport' => $faker->isbn10,
            'registration' => $faker->address,
            'date_of_birth' => $faker->date('Y-m-d', '2001-12-01'),
            'person_id' => $faker->numberBetween(1, 50),
        ];
    }
}

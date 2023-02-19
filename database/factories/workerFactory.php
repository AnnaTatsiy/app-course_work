<?php

namespace Database\Factories;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

class workerFactory extends Factory
{
    protected $faker;

    public function definition(): array
    {
        $faker = app(Generator::class);

        return [
            'workers_category' =>  $faker->numberBetween(1, 5),
            'experience' =>  $faker->numberBetween(1, 20),
            'person_id' => $faker->numberBetween(1, 50),
            'specialization_id' => $faker->numberBetween(1, 30),
        ];
    }
}

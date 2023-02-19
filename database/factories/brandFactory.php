<?php

namespace Database\Factories;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

class brandFactory extends Factory
{
    protected $faker;

    public function definition(): array
    {
        $faker = app(Generator::class);

        return [
            'name_brand' =>  $faker->unique()->company
        ];
    }
}

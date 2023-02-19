<?php

namespace Database\Factories;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

class personFactory extends Factory
{
    protected $faker;

    public function definition(): array
    {
        $faker = app(Generator::class);

        $gender = $faker->randomElements(['male', 'female'])[0];

        $patronymic = ["Мирославов", "Константинов",
            "Тимофеев", "Владимиров", "Марков",
            "Ярославов", "Даниилов", "Давидов", "Ибрагимов",
            "Андреев", "Фёдоров", "Артёмов", "Александров", "Демидов",
            "Артёмов", "Давидов", "Арсентьев", "Маратов", "Даниилов",
            "Егоров", "Вадимов", "Сергеев"];

        $p = $faker->randomElements($patronymic)[0];
        $p .= ($gender == 'male') ? "ич" : "на";

        return [

            'name'=> $faker->firstName($gender),
            'surname' =>  $faker->lastName($gender),
            'patronymic' =>  $p,
        ];
    }
}

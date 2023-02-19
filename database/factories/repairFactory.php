<?php

namespace Database\Factories;

use DateTime;
use Exception;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

class repairFactory extends Factory
{
    protected $faker;

    /**
     * @throws Exception
     */
    public function definition(): array
    {
        $faker = app(Generator::class);

        $m = $faker->numberBetween(date('m')-1, date('m'));

        $d = ($m == date('m')-1) ? $faker->numberBetween(1, 28) :  $faker->numberBetween(1, date('d'));

        $date_of_detection = date('Y')."-".$m."-".$d;

        $interval = $faker->numberBetween(5, 14);
        if($d + $interval > 28){
            $interval = $d + $interval - 28;
            $next = ++$m;
        }
        else{

            $interval = $d + $interval;
            $next = $m;
        }

        $bool = $faker->numberBetween(-2, 10) > 0;

        return [
            'date_of_detection' =>  $date_of_detection,
            'date_of_correction' => date('Y')."-".$next."-".$interval,
            'is_fixed' =>  $bool,

            'malfunction_id' => $faker->numberBetween(1, 30),
            'worker_id' => $faker->numberBetween(1, 50),
            'car_id' => $faker->numberBetween(1, 50),
            'client_id' => $faker->numberBetween(1, 50),
            'spare_part_id' => $faker->numberBetween(1, 30),

        ];
    }
}

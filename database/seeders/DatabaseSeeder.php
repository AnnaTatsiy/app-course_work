<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\color;
use App\Models\brand;
use App\Models\person;
use App\Models\specialization;
use App\Models\spare_part;
use App\Models\malfunction;
use App\Models\client;
use App\Models\worker;
use App\Models\car;
use App\Models\repair;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        color::factory(20)->create();
        brand::factory(30)->create();
        person::factory(50)->create();
        specialization::factory(30)->create();
        spare_part::factory(30)->create();
        malfunction::factory(30)->create();
        client::factory(50)->create();
        worker::factory(50)->create();
        car::factory(70)->create();
        repair::factory(150)->create();
    }
}

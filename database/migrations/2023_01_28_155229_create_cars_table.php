<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');  // первичный ключ, моджно явно указать имя

            $table->integer('year_of_release');
            $table->string('state_number',9);   // varchar(45)

            $table->unsignedInteger('brand_id');
            $table->unsignedInteger('color_id');
            $table->unsignedInteger('client_id');

            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('client_id')->references('id')->on('clients');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
};

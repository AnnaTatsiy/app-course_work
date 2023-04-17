<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->increments('id');

            $table->date("date_of_detection");//Дата выявления неисправность
            $table->date("date_of_correction");//Дата исправления неисправность
            $table->boolean("is_fixed");//Признак  исправленности поломки

            $table->unsignedInteger('malfunction_id');
            $table->foreign('malfunction_id')->references('id')->on('malfunctions');

            $table->unsignedInteger('worker_id');
            $table->foreign('worker_id')->references('id')->on('workers');

            $table->unsignedInteger('car_id');
            $table->foreign('car_id')->references('id')->on('cars');

            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');

            $table->unsignedInteger('spare_part_id');
            $table->foreign('spare_part_id')->references('id')->on('spare_parts');

            $table->timestamps();

        });
    }


    public function down()
    {
        Schema::dropIfExists('repairs');
    }
};

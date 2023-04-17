<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->increments('id');  // первичный ключ, моджно явно указать имя

            $table->integer('workers_category');//Разряд рабочего
            $table->integer('experience');//Стаж

            $table->unsignedInteger('person_id');
            $table->foreign('person_id')->references('id')->on('people');

            $table->unsignedInteger('specialization_id');
            $table->foreign('specialization_id')->references('id')->on('specializations');

            $table->timestamps();
            $table->softDeletes();                          // добавляет солбец deleted_at для "мягкого удаления"

        });
    }

    public function down()
    {
        Schema::dropIfExists('workers');
    }
};

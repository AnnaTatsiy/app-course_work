<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('spare_parts', function (Blueprint $table) {
            $table->increments('id');  // первичный ключ, моджно явно указать имя

            $table->string('name_spare_part',255);   // varchar(45)
            $table->integer('price');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('spare_parts');
    }
};

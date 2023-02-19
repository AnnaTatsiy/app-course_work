<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');  // первичный ключ, моджно явно указать имя

            $table->string('name',45);   // varchar(45)
            $table->string('surname',45);   // varchar(45)
            $table->string('patronymic',45);   // varchar(45)

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('people');
    }
};

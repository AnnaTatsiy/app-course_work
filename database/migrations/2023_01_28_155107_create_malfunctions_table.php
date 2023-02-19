<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('malfunctions', function (Blueprint $table) {
            $table->increments('id');  // первичный ключ, моджно явно указать имя

            $table->string('name_malfunction',1000);   // varchar(45)
            $table->integer('price');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('malfunctions');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->increments('id');  // первичный ключ, моджно явно указать имя
            $table->string('name_color',45);   // varchar(45)

            // моменты времени создания и последнего доступа
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('colors');
    }
};

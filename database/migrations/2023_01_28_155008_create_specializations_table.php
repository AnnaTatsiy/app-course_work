<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('specializations', function (Blueprint $table) {
            $table->increments('id');  // первичный ключ, моджно явно указать имя
            $table->string('name_specialization',45);   // varchar(45)

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('specializations');
    }
};

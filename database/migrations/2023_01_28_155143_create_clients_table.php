<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');  // первичный ключ, моджно явно указать имя

            $table->string('passport',10);   // varchar(45)
            $table->string('registration',255);   // varchar(45)
            $table->date('date_of_birth');

            $table->unsignedInteger('person_id');
            $table->foreign('person_id')->references('id')->on('people');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
};

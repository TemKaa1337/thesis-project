<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cinemas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('halls')->nullable();
            $table->string('cinema_image');
            $table->string('description')->nullable();
            $table->dateTime('date_created')->nullable();
            $table->boolean('terminal')->nullable();
            $table->boolean('bar')->nullable();
            $table->boolean('parking')->nullable();
            $table->string('metro')->nullable();
            $table->string('phones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cinemas');
    }
}

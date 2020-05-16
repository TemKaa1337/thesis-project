<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_times', function (Blueprint $table) {
            $table->id();
            $table->integer('film_id');
            $table->date('date_shown');
            $table->dateTime('datetime_shown');
            $table->string('cinema_name');
            $table->json('hall_places');
            $table->integer('cinema_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session_times');
    }
}

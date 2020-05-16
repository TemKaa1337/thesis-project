<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBookedPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_booked_places', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('film_id');
            $table->dateTime('datetime_shown');
            $table->string('cinema');
            $table->json('booked_places');
            $table->integer('attempt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_booked_places');
    }
}

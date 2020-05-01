<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('preview_image');
            $table->string('film_page_image');
            $table->string('description', 1500);
            $table->string('genre');
            $table->date('date_shown_from');
            $table->date('date_shown_to');
            $table->string('country');
            $table->string('year');
            $table->string('duration');
            $table->string('producer');
            $table->string('actors');
            $table->string('age_restriction');
            $table->string('trailer');
            $table->integer('is_shown');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films');
    }
}

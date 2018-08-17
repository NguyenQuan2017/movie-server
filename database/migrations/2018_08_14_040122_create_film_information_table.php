<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_information', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->year('year');
            $table->string('high_definition');
            $table->string('episode_number');
            $table->double('view')->default(0);
            $table->integer('film_id')->unsigned()->unique('film_id');
            $table->foreign('film_id')->references('id')->on('films')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film_information');
    }
}

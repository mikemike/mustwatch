<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('title')->index();
            $table->string('year');
            $table->string('rated')->index();
            $table->string('released')->index();
            $table->string('runtime');
            $table->string('genre');
            $table->string('director');
            $table->string('writer');
            $table->string('actors');
            $table->text('plot');
            $table->string('language');
            $table->string('country');
            $table->string('awards');
            $table->string('poster');
            $table->string('metascore');
            $table->string('imdb_id')->index();
            $table->string('imdb_rating');
            $table->string('imdb_votes');
            $table->string('tomato_meter');
            $table->string('tomato_image');
            $table->string('tomato_rating');
            $table->string('tomato_reviews');
            $table->string('tomato_fresh');
            $table->string('tomato_rotten');
            $table->text('tomato_consensus');
            $table->string('tomato_user_meter');
            $table->string('tomato_user_rating');
            $table->string('tomato_user_num_reviews');
            $table->string('tomato_url');
            $table->string('dvd');
            $table->string('box_office');
            $table->string('production');
            $table->string('website');
            $table->boolean('partially_complete')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('movies');
    }
}

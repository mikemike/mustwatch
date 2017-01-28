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
            $table->string('runtime')->nullable();
            $table->string('genre')->nullable();
            $table->string('director')->nullable();
            $table->string('writer')->nullable();
            $table->string('actors')->nullable();
            $table->text('plot')->nullable();
            $table->string('language')->nullable();
            $table->string('country')->nullable();
            $table->string('awards')->nullable();
            $table->string('poster')->nullable();
            $table->string('metascore');
            $table->string('imdb_id')->index();
            $table->string('imdb_rating');
            $table->string('imdb_votes');
            $table->string('tomato_meter')->nullable();
            $table->string('tomato_image')->nullable();
            $table->string('tomato_rating')->nullable();
            $table->string('tomato_reviews')->nullable();
            $table->string('tomato_fresh')->nullable();
            $table->string('tomato_rotten')->nullable();
            $table->text('tomato_consensus')->nullable();
            $table->string('tomato_user_meter')->nullable();
            $table->string('tomato_user_rating')->nullable();
            $table->string('tomato_user_num_reviews')->nullable();
            $table->string('tomato_url')->nullable();
            $table->string('dvd')->nullable();
            $table->string('box_office')->nullable();
            $table->string('production')->nullable();
            $table->string('website')->nullable();
            $table->boolean('full_listing')->default(false)->comment('Do we have a full data set?');
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

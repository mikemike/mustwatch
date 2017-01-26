<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Movie extends Model
{
    use Searchable;

    protected $fillable = [
        'type',
        'title',
        'slug',
        'year',
        'rated',
        'released',
        'runtime',
        'genre',
        'director',
        'writer',
        'actors',
        'plot',
        'language',
        'country',
        'awards',
        'poster',
        'metascore',
        'imdb_rating',
        'imdb_votes',
        'imdb_id',
        'type',
        'tomato_meter',
        'tomato_image',
        'tomato_rating',
        'tomato_reviews',
        'tomato_fresh',
        'tomato_rotten',
        'tomato_consensus',
        'tomato_user_meter',
        'tomato_user_rating',
        'tomato_user_reviews',
        'tomato_url',
        'dvd',
        'box_office',
        'production',
        'website',
        'partially_complete'
    ];

    /**
     * The users who want to watch this movie.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_movie', 'movie_id', 'user_id')->withTimestamps();
    }
}

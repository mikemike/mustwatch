<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Mikemike\MovieDB;

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
        'full_listing'
    ];

    /**
     * The users who want to watch this movie.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_movie', 'movie_id', 'user_id')->withTimestamps();
    }

    /**
     * Grab all details from a partial entity and update the database
     */
    public function get_full($movie)
    {
        // Grab the full record
        $omdb = \MovieDB::getMovie($movie->imdb_id);

        if(!empty($omdb)) {
            if(empty($omdb['Error']) && isset($omdb['Response']) && $omdb['Response'] == 'True') {

                $new_data = [
                    'title' => (empty($omdb['Title']) ? '' : $omdb['Title']),
                    'slug' => (empty($omdb['Title']) ? '' : str_slug($omdb['Title'])),
                    'year' => (empty($omdb['Year']) ? '' : $omdb['Year']),
                    'rated' => (empty($omdb['Rated']) ? '' : $omdb['Rated']),
                    'released' => (empty($omdb['Released']) ? '' : $omdb['Released']),
                    'runtime' => (empty($omdb['Runtime']) ? '' : str_replace(' min', '', $omdb['Runtime'])),
                    'genre' => (empty($omdb['Genre']) ? '' : $omdb['Genre']),
                    'director' => (empty($omdb['Director']) ? '' : $omdb['Director']),
                    'writer' => (empty($omdb['Writer']) ? '' : $omdb['Writer']),
                    'actors' => (empty($omdb['Actors']) ? '' : $omdb['Actors']),
                    'plot' => (empty($omdb['Plot']) ? '' : $omdb['Plot']),
                    'language' => (empty($omdb['Language']) ? '' : $omdb['Language']),
                    'country' => (empty($omdb['Country']) ? '' : $omdb['Country']),
                    'awards' => (empty($omdb['Awards']) ? '' : $omdb['Awards']),
                    'poster' => (empty($omdb['Poster']) || $omdb['Poster'] == 'N/A' ? '' : $omdb['Poster']),
                    'metascore' => (empty($omdb['Metascore']) ? '' : $omdb['Metascore']),
                    'imdb_rating' => (empty($omdb['imdbRating']) ? '' : $omdb['imdbRating']),
                    'imdb_votes' => (empty($omdb['imdbVotes']) ? '' : str_replace(',', '', $omdb['imdbVotes'])),
                    'imdb_id' => (empty($omdb['imdbID']) ? '' : $omdb['imdbID']),
                    'type' => (empty($omdb['Type']) ? '' : $omdb['Type']),
                    'tomato_meter' => (empty($omdb['tomatoMeter']) ? '' : $omdb['tomatoMeter']),
                    'tomato_image' => (empty($omdb['tomatoImage']) ? '' : $omdb['tomatoImage']),
                    'tomato_rating' => (empty($omdb['tomatoRating']) ? '' : $omdb['tomatoRating']),
                    'tomato_reviews' => (empty($omdb['tomatoReviews']) ? '' : $omdb['tomatoReviews']),
                    'tomato_fresh' => (empty($omdb['tomatoFresh']) ? '' : $omdb['tomatoFresh']),
                    'tomato_rotten' => (empty($omdb['tomatoRotten']) ? '' : $omdb['tomatoRotten']),
                    'tomato_consensus' => (empty($omdb['tomatoConsensus']) ? '' : $omdb['tomatoConsensus']),
                    'tomato_user_meter' => (empty($omdb['tomatoUserMeter']) ? '' : $omdb['tomatoUserMeter']),
                    'tomato_user_rating' => (empty($omdb['tomatoUserRating']) ? '' : $omdb['tomatoUserRating']),
                    'tomato_user_num_reviews' => (empty($omdb['tomatoUserReviews']) ? '' : $omdb['tomatoUserReviews']),
                    'tomato_url' => (empty($omdb['tomatoURL']) ? '' : $omdb['tomatoURL']),
                    'dvd' => (empty($omdb['DVD']) ? '' : $omdb['DVD']),
                    'box_office' => (empty($omdb['BoxOffice']) ? '' : $omdb['BoxOffice']),
                    'production' => (empty($omdb['Production']) ? '' : $omdb['Production']),
                    'website' => (empty($omdb['Website']) ? '' : $omdb['Website'])
                ];
                $movie->fill($new_data);

                if(!empty($movie->plot) && !empty($movie->poster)) {
                    $movie->full_listing = 1;
                } else {
                    $movie->full_listing = 0;
                }
                
                $movie->save();
                $movie->searchable();
            }
        }
        return $movie;
    }
}

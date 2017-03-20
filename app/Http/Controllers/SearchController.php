<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Movie;
use Mikemike\MovieDB;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * User wants to search
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('search.index');
    }

    /**
     * AJAX autocomplete
     *
     * @return String JSON
     */
    public function ajax_search(Request $request)
    {
        $query = $request->input('q');

        if(empty($query)) {
            return response()->json([]);
        }

        $data = [
            'movies' => [],
            'count' => 0,
            'logged_in' => Auth::check()
        ];

        if($data['logged_in']) {
            $user = Auth::user();
        }

        // Search the database
        //$db_movies = Movie::search($query)->get();

        // If less than the required results then grab the rest from the API
        //if($db_movies->count() < config('mustwatch.max_results')) {
            $page = 1;
            $should_end = false;

            while(!$should_end && $page < 4) {
                $omdb = \MovieDB::search_query($query, $page);
                // Save any API results to the database
                if(!empty($omdb)) {
                    if(empty($omdb['Error'])) {
                        $omdb_movies = [];
                        foreach($omdb['Search'] as $omdb_result){
                            $local_movie = Movie::where('imdb_id', $omdb_result['imdbID'])->first();

                            $new_data = [
                                'title' => (empty($omdb_result['Title']) ? '' : $omdb_result['Title']),
                                'slug' => (empty($omdb_result['Title']) ? '' : str_slug($omdb_result['Title'])),
                                'year' => (empty($omdb_result['Year']) ? '' : $omdb_result['Year']),
                                'rated' => (empty($omdb_result['Rated']) ? '' : $omdb_result['Rated']),
                                'released' => (empty($omdb_result['Released']) ? '' : $omdb_result['Released']),
                                'runtime' => (empty($omdb_result['Runtime']) ? '' : str_replace(' min', '', $omdb_result['Runtime'])),
                                'genre' => (empty($omdb_result['Genre']) ? '' : $omdb_result['Genre']),
                                'director' => (empty($omdb_result['Director']) ? '' : $omdb_result['Director']),
                                'writer' => (empty($omdb_result['Writer']) ? '' : $omdb_result['Writer']),
                                'actors' => (empty($omdb_result['Actors']) ? '' : $omdb_result['Actors']),
                                'plot' => (empty($omdb_result['Plot']) ? '' : $omdb_result['Plot']),
                                'language' => (empty($omdb_result['Language']) ? '' : $omdb_result['Language']),
                                'country' => (empty($omdb_result['Country']) ? '' : $omdb_result['Country']),
                                'awards' => (empty($omdb_result['Awards']) ? '' : $omdb_result['Awards']),
                                'poster' => (empty($omdb_result['Poster']) || $omdb_result['Poster'] == 'N/A' ? '' : $omdb_result['Poster']),
                                'remote_poster' => (empty($omdb_result['Poster']) || $omdb_result['Poster'] == 'N/A' ? '' : $omdb_result['Poster']),
                                'metascore' => (empty($omdb_result['Metascore']) ? '' : $omdb_result['Metascore']),
                                'imdb_rating' => (empty($omdb_result['imdbRating']) ? '' : $omdb_result['imdbRating']),
                                'imdb_votes' => (empty($omdb_result['imdbVotes']) ? '' : str_replace(',', '', $omdb_result['imdbVotes'])),
                                'imdb_id' => (empty($omdb_result['imdbID']) ? '' : $omdb_result['imdbID']),
                                'type' => (empty($omdb_result['Type']) ? '' : $omdb_result['Type']),
                                'tomato_meter' => (empty($omdb_result['tomatoMeter']) ? '' : $omdb_result['tomatoMeter']),
                                'tomato_image' => (empty($omdb_result['tomatoImage']) ? '' : $omdb_result['tomatoImage']),
                                'tomato_rating' => (empty($omdb_result['tomatoRating']) ? '' : $omdb_result['tomatoRating']),
                                'tomato_reviews' => (empty($omdb_result['tomatoReviews']) ? '' : $omdb_result['tomatoReviews']),
                                'tomato_fresh' => (empty($omdb_result['tomatoFresh']) ? '' : $omdb_result['tomatoFresh']),
                                'tomato_rotten' => (empty($omdb_result['tomatoRotten']) ? '' : $omdb_result['tomatoRotten']),
                                'tomato_consensus' => (empty($omdb_result['tomatoConsensus']) ? '' : $omdb_result['tomatoConsensus']),
                                'tomato_user_meter' => (empty($omdb_result['tomatoUserMeter']) ? '' : $omdb_result['tomatoUserMeter']),
                                'tomato_user_rating' => (empty($omdb_result['tomatoUserRating']) ? '' : $omdb_result['tomatoUserRating']),
                                'tomato_user_num_reviews' => (empty($omdb_result['tomatoUserReviews']) ? '' : $omdb_result['tomatoUserReviews']),
                                'tomato_url' => (empty($omdb_result['tomatoURL']) ? '' : $omdb_result['tomatoURL']),
                                'dvd' => (empty($omdb_result['DVD']) ? '' : $omdb_result['DVD']),
                                'box_office' => (empty($omdb_result['BoxOffice']) ? '' : $omdb_result['BoxOffice']),
                                'production' => (empty($omdb_result['Production']) ? '' : $omdb_result['Production']),
                                'website' => (empty($omdb_result['Website']) ? '' : $omdb_result['Website'])
                            ];

                            if(empty($local_movie)) {
                                $local_movie = Movie::create($new_data);
                            } else {
                                $local_movie->fill($new_data);
                            }
                            $local_movie->searchable();
                            
                            // Check if the user has this film added
                            if($data['logged_in']) {
                                if($user->movies->contains($local_movie->id)) {
                                    $local_movie->has_added = true;
                                } else {
                                    $local_movie->has_added = false;
                                }
                            }

                            $local_movie->source = 'omdb';
                            $omdb_movies[] = $local_movie;
                        }
                        
                    } else {
                        $data['error'] = $omdb['Error'];
                        $should_end = true;
                    }
                } else {
                    $should_end = true;
                }

                $page++;
            } // EO While
        //}

        if(/*$db_movies->isEmpty() &&*/ empty($omdb_movies)) {
            $data['count'] = 0;
        } else {
            if(!empty($omdb_movies)) {
                $data['count'] = count($omdb_movies);
            }/* else {
                $data['count'] = $db_movies->count();
            }*/
        }

        // If we have any omdb movies lets just use those rather than merging as it prevents dupes
        if(empty($omdb_movies)) {
            $movies = [];
            // Loop through DB movies if user is logged in
            /*if($data['logged_in']) {
                foreach($db_movies as $db_movie) {
                // Check if the user has this film added
                    if($user->movies->contains($db_movie->id)) {
                        $db_movie->has_added = true;
                    } else {
                        $db_movie->has_added = false;
                    }
                }
            }
            $movies = $db_movies->toArray();*/
        } else {
            $movies = $omdb_movies;
        }

        // Lastly, foreach and only return items with poster art.  This rules out 
        // most of the pointless titles
        $final_array = [];
        foreach($movies as $movie) {
            if(!empty($movie['poster'])){
                $final_array[] = $movie;
            }
        }

        $data['movies'] = $final_array;

        return response()->json($data);
    }
}

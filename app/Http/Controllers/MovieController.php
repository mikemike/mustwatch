<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Movie;
use Mikemike\MovieDB;

class MovieController extends Controller
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
     * Show movie details
     *
     * @return \Illuminate\Http\Response
     */
    public function view($slug, $id)
    {
        $movie = Movie::find($id);

        // Does the movie exist?
        if(empty($movie)) {
            return view('movies.not-found');
        }

        // Do we have a complete record?
        if($movie->full_listing == 0) {
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
        }

        return view('movies.view', [
            'movie' => $movie
        ]);
    }

    // --------------

    /**
     * AJAX add movie
     *
     * @return String JSON
     */
    public function ajax_add_movie(Request $request)
    {
        $data = [];
        $data['logged_in'] = Auth::check();

        if($data['logged_in'] == false) {
            return response()->json($data);    
        }

        $movie_id = $request->input('movie_id');
        if(empty($movie_id)) {
            $data['error'] = 'Movie not found, please try again.';
            return response()->json($data);
        }

        $user = Auth::user();
        $user->movies()->syncWithoutDetaching([$movie_id]);

        $data['success'] = true;

        return response()->json($data);
    }

    /**
     * AJAX remove movie
     *
     * @return String JSON
     */
    public function ajax_remove_movie(Request $request)
    {
        $data = [];
        $data['logged_in'] = Auth::check();

        if($data['logged_in'] == false) {
            return response()->json($data);    
        }

        $movie_id = $request->input('movie_id');
        if(empty($movie_id)) {
            $data['error'] = 'Movie not found, please try again.';
            return response()->json($data);
        }

        $user = Auth::user();
        $user->movies()->detach($movie_id);

        $data['success'] = true;

        return response()->json($data);
    }

    /**
     * AJAX mark as watched
     *
     * @return String JSON
     */
    public function ajax_mark_watched(Request $request)
    {
        $data = [];
        $data['logged_in'] = Auth::check();

        if($data['logged_in'] == false) {
            return response()->json($data);    
        }

        $movie_id = $request->input('movie_id');
        if(empty($movie_id)) {
            $data['error'] = 'Movie not found, please try again.';
            return response()->json($data);
        }

        $user = Auth::user();
        $user->movies()->updateExistingPivot($movie_id, ['has_watched' => 1]);

        $data['success'] = true;

        return response()->json($data);
    }

    /**
     * AJAX mark as unwatched
     *
     * @return String JSON
     */
    public function ajax_mark_unwatched(Request $request)
    {
        $data = [];
        $data['logged_in'] = Auth::check();

        if($data['logged_in'] == false) {
            return response()->json($data);    
        }

        $movie_id = $request->input('movie_id');
        if(empty($movie_id)) {
            $data['error'] = 'Movie not found, please try again.';
            return response()->json($data);
        }

        $user = Auth::user();
        $user->movies()->updateExistingPivot($movie_id, ['has_watched' => 0]);

        $data['success'] = true;

        return response()->json($data);
    }
}

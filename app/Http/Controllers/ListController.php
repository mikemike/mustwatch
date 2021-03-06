<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Movie;
use App\User;

class ListController extends Controller
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
     * List all favourited movies
     *
     * @return \Illuminate\Http\Response
     */
    public function list_movies($username)
    {
        $user = User::where('username', $username)->first();

        // Does the movie exist?
        if(empty($user)) {
            abort(404);
        }

        $movies = $user->movies;

        // Do the movies exist?
        if($movies->count() == 0) {
            return view('list.none-found', [
                'user' => $user
            ]);
        }

        // Build a list of available filters
        $filters = [];
        foreach($movies as $movie) {
            $genres = explode(', ', $movie->genre);
            foreach($genres as $genre) {
                if(!in_array($genre, $filters)) {
                    $filters[] = $genre;
                }
            }
        }

        // Is the user logged in?  If so, get a list of their movies 
        $user_movies = [];
        $user_movies_ids = [];
        $user_watched_ids = [];
        if(Auth::check()) {
            $user_movies = Auth::user()->movies();
            $user_movies_ids = $user_movies->pluck('movies.id')->toArray();
            $user_watched_ids = $user_movies->where('has_watched', true)->pluck('movies.id')->toArray();
        }
        
        // Build share button text 
        $current_url = \Request::fullUrl();
        $tweet_text = rawurlencode('Check out my Must Watch list on '. config('app.name') .' '. $current_url);
        $fb_text = $tweet_text;

        return view('list.view', [
            'user' => $user,
            'movies' => $movies,
            'filters' => $filters,
            'current_url' => $current_url,
            'tweet_text' => $tweet_text,
            'fb_text' => $fb_text,
            'user_movies' => $user_movies,
            'user_movies_ids' => $user_movies_ids,
            'user_watched_ids' => $user_watched_ids,
        ]);
    }    
}

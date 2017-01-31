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
    public function list_movies($id)
    {
        $user = User::findOrFail($id);

        $movies = $user->movies;

        // Does the movie exist?
        if(empty($movies)) {
            return view('list.none-found');
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
        ]);
    }    
}

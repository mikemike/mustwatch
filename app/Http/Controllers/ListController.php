<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Movie;

class ListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List all favourited movies
     *
     * @return \Illuminate\Http\Response
     */
    public function list_movies()
    {
        $movies = Auth::user()->movies;

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

        return view('list.view', [
            'movies' => $movies,
            'filters' => $filters
        ]);
    }    
}

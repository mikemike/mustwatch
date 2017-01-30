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

        return view('list.view', [
            'user' => $user,
            'movies' => $movies,
            'filters' => $filters
        ]);
    }    
}

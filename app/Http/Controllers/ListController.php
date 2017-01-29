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
        $this->middleware('auth');
    }

    /**
     * List all favourited movies
     *
     * @return \Illuminate\Http\Response
     */
    public function list_all()
    {
        $movies = Auth::user()->movies;

        // Does the movie exist?
        if(empty($movies)) {
            return view('list.none-found');
        }

        return view('list.view', [
            'movies' => $movies
        ]);
    }

    
}

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
}

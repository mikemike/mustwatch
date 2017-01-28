<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Movie;
use Event;
use App\Events\MovieAddedAsToWatch;
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
            $movie->get_full($movie);
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

        Event::fire(new MovieAddedAsToWatch($movie_id));

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

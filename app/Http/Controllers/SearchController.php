<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'count' => 0
        ];

        // Search the database
        $movies = Movie::search($query)->get();

        // If less than the required results then grab the rest from the API
        if($movies->count() < config('mustwatch.max_results')) {
            $omdb = \MovieDB::query($query);
            
            // Save any API results to the database
            if(!empty($omdb)) {
                if(empty($omdb['Error'])) {
                    $omdb['type'] = 'OMDB';
                    Movie::updateOrCreate(
                        $omdb,                        
                        ['imdb_id' => $omdb['imdbID']]
                    );
                } else {
                    $data['error'] = $omdb['Error'];
                }
            }
        }

        if(empty($movies) && empty($omdb)) {
            $data['count'] = 0;
        } else {
            if(!empty($movies)) {
                $data['movies'] = array_merge($data['movies'], $movies);
            }
            if(!empty($omdb)) {
                $data['movies'] = array_merge($data['movies'], $omdb);
            }
            $data['count'] = count($data['movies']);
        }

        return response()->json($data);
    }
}

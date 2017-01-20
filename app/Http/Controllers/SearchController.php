<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movies;

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
    public function ajax_search()
    {
        // Search the database
        

        // If less than the required results then grab the rest from the API

        // Save any API results to the database

        // Return to user        

        return response()->json($data);
    }
}

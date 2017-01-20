<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}

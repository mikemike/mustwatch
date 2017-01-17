<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DigiPig\MovieDB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $MoviesArray = \MovieDB::getMovie('tt2937696');
        dd($MoviesArray);
        return view('home');
    }
}

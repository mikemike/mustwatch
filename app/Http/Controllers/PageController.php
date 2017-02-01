<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use DB;

class PageController extends Controller
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
     * Show the home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $recents = Movie::orderBy('id')
            ->where('poster', '<>', '', 'and')
            ->orderBy('views', 'desc')
            ->orderBy(\DB::raw('RAND()'))
            ->limit(50)
            ->get();

        return view('pages.home', [
            'recents' => $recents
        ]);
    }

    /**
     * Show the about page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Show the contact page.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Show the privacy page.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacy()
    {
        return view('pages.privacy');
    }
}

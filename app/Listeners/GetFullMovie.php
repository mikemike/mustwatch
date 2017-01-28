<?php

namespace App\Listeners;

use App\Events\MovieAddedAsToWatch;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Movie;

class GetFullMovie
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MovieAddedAsToWatch  $event
     * @return void
     */
    public function handle(MovieAddedAsToWatch $event)
    {
        $movie = Movie::find($event->movie_id);
        if($movie->full_listing == 0) {
            $movie->get_full($movie);
        }
        return true;
    }
}

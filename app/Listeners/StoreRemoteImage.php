<?php

namespace App\Listeners;

use App\Events\MovieFullPulledWithNoLocalImage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Movie;

class StoreRemoteImage
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
    public function handle(MovieFullPulledWithNoLocalImage $event)
    {
        $movie = Movie::find($event->movie_id);
        if($movie->has_local_image == 0) {
            if(!empty($movie->remote_poster)) {
                // Randomly place in a a-z folder
                $str = 'abcdefghijklmnopqrstuvwxyz';
                $random_char = $str[rand(0, strlen($str)-1)];

                $ext = pathinfo($movie->remote_poster, PATHINFO_EXTENSION);

                $filename = $movie->slug .'-'. $movie->id .'-'. time() .'.'. $ext;

                copy($movie->remote_poster, public_path('assets/img/posters/'. $random_char .'/'. $filename));

                $movie->poster = '/assets/img/posters/'. $random_char .'/'. $filename;
                $movie->has_local_poster = 1;
                $movie->save();
            }
        }
        return true;
    }
}

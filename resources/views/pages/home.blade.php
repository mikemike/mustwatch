@extends('layouts.app')

@section('title', 'Movie and TV show favourite lists')
@section('meta_description', 'Create your own Must Watch movie and TV show list so you can remember and share your must watch film choices.')

@section('content')
    
    </div> <!-- .container -->

    <div class="hero">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="titles">
                        <h1>Bookmark Movies &amp; TV Shows</h1>
                        <h2>Track what you watch and get recommendations</h2>
                        <a href="/search" class="btn btn-primary btn-lg">Search for a Movie or TV Show</a>
                    </div>

                </div> <!-- .col-md-12 -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .hero -->

    <div class="slider">
        <h2 class="text-center">Recent Searches</h2>

        <div class="slidethis">
            @foreach($recents as $recent)
            <div class="movie-item">
                <a href="{{ route('movie.view', [$recent->slug, $recent->id])}}">
                    <img src="{{ $recent->poster }}">
                </a>
            </div> <!-- .movie-item -->
            @endforeach
        </div> <!-- .slidethis -->
    </div> <!-- .slider -->

    <div class="features">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center">Features</h2>                    
                </div>
            </div> <!-- .row -->
            <div class="row">
                <div class="col-md-4">
                    <svg class="lnr lnr-camera-video"><use xlink:href="#lnr-camera-video"></use></svg>
                    <h3>Every Movie and TV Show</h3>
                    <p>
                        We have every movie and TV show you can think of, so even the most 
                        niche film fanatics can get involved.
                    </p>
                </div> <!-- .col-md-4 -->
                
                <div class="col-md-4">
                    <svg class="lnr lnr-star"><use xlink:href="#lnr-star"></use></svg>
                    <h3>Favourite &amp; Bookmark</h3>
                    <p>
                        Bookmark TV shows and movies whenever you think of them, and then use 
                        the filters to find something to watch that suits your mood.
                    </p>
                </div> <!-- .col-md-4 -->
                
                <div class="col-md-4">
                    <svg class="lnr lnr-users"><use xlink:href="#lnr-users"></use></svg>
                    <h3>Keep Track and Share</h3>
                    <p>
                        You can share your profile with others to let them know what you have watched 
                        and to help them find something good you have found.
                    </p>
                </div> <!-- .col-md-4 -->
            </div> <!-- .row -->
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="/login" class="btn btn-primary btn-lg">Get Started for Free</a> 
                </div>
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .features -->

    <div class="container">

@endsection

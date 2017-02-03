@extends('layouts.app')

@section('title', $user->name . '\' Must Watch List')
@section('meta_description', $user->name . '\' Must Watch list.  The movies and TV shows they want to watch, and have watched.')
@section('og_type', 'profile')
@section('og_title', $user->name .' Must Watch List')
@section('og_description', $user->name .' list of movies and TV shows to watch')

@section('content')
    <div class="row your-list">
        <div class="col-md-12">


            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>{{ $user->name }} Must Watch List
                    <span class="text-muted pull-right">{{ count($movies) }} movies and shows</span></h1>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="filters">
                                <h4>Filter</h4>
                                <div class="genres">
                                    <button data-filter="*" class="btn btn-sm btn-success disabled">All</button>
                                    @foreach($filters as $filter)
                                        <button data-filter=".{{ str_slug($filter) }}" class="btn btn-sm btn-info">{{ $filter }}</button>
                                    @endforeach
                                </div> <!-- .genres -->

                                <div class="watched">
                                    <button data-filter="*" class="btn btn-sm btn-success disabled">Both</button>
                                    <button data-filter="not-watched" class="btn btn-sm btn-info">Not watched</button>
                                    <button data-filter="watched" class="btn btn-sm btn-info">Watched</button>
                                </div> <!-- .watched -->
                            </div> <!-- .filters -->
                        </div> <!-- .col-md-8 -->
                        <div class="col-md-4">
                            <div class="sort">                                
                                <h4>Sort</h4>
                                <button data-filter="original-order" class="btn btn-sm btn-success disabled">Name</button>
                                <button data-filter="year" class="btn btn-sm btn-success">Year (newest first)</button>
                                <button data-filter="rating" class="btn btn-sm btn-success">Rating</button>
                                <button data-filter="random" class="btn btn-sm btn-success">Random</button>
                            </div> <!-- .sort -->

                            <div class="social">
                                <h4>Share</h4>
                                <a href="https://twitter.com/intent/tweet?text={{ $tweet_text }}" target="_blank" class="btn btn-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="https://www.facebook.com/sharer/sharer.php?t={{ $fb_text }}&u={{ $current_url }}" target="_blank" class="btn btn-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>                                
                            </div> <!-- .social -->
                        </div> <!-- .col-md-4 -->
                    </div> <!-- .row -->

                    <div id="results">
                        <div class="row is-flex">
                        @foreach($movies as $movie)
                            <div class="col-md-2 col-xs-6 @foreach(explode(', ', $movie->genre) as $genre) {{ str_slug($genre) }} @endforeach" 
                                data-watched="{{ $movie->pivot->has_watched ? 'watched' : 'not-watched' }}"
                                data-year="{{ $movie->year }}"
                                data-rating="{{ $movie->imdb_rating * 10 }}">
                                <div class="movie">
                                    <a href="/title/{{ $movie->slug }}/{{ $movie->id }}"><img src="{{ $movie->poster }}" class="poster" onerror="imgError(this);"></a>
                                    <a href="/title/{{ $movie->slug }}/{{ $movie->id }}"><h2>{{ $movie->title }}</h2></a>
                                    <p class="text-muted pull-left">{{ $movie->year }}</p>
                                    <p class="text-muted text-right">{{ $movie->type }}</p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $movie->imdb_rating*10 }}%;">
                                            {{ $movie->imdb_rating }}/10
                                        </div>
                                    </div>
                                    @if(Auth::guest()) {
                                        <p class="btn-area"><a href="/login" class="btn btn-primary btn-sm btn-block">Login to Add</a></p>
                                    @else
                                        <p class="btn-area">
                                            @if(Auth::user()->movies()->find($movie->id)->pivot->has_watched)
                                                <a href="javascript:void(0);" class="btn btn-warning btn-sm btn-block btn-mark-watched" data-is-watched="1" data-id="{{ $movie->id }}">Mark as not-watched</a>
                                            @else
                                                <a href="javascript:void(0);" class="btn btn-info btn-sm btn-block btn-mark-watched" data-is-watched="0" data-id="{{ $movie->id }}">Mark as watched</a>
                                            @endif
                                            <a href="javascript:void(0);" class="btn btn-danger btn-sm btn-block btn-add" data-on-list="1" data-id="{{ $movie->id }}">Remove from your list</a>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        </div> <!-- .row -->
                    </div> <!-- #results -->

                </div>
            </div> <!-- .panel -->

        </div> <!-- .col-md-12 -->
        
    </div> <!-- .row -->
@endsection

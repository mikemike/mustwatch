@extends('layouts.app')

@section('title', $movie->title)
@section('meta_description', 'Add '.$movie->title.' to your must-watch list and keep it bookmarked.')
@section('og_type', 'video.' . $movie->type)
@section('og_title', $movie->title)
@section('og_description', 'Bookmark '. $movie->title .' as something to watch.  Do the same on '. config('app.name'))
@if(!empty($movie->poster))
    @section('og_image', url($movie->poster))
@endif

@section('content')
    <div class="row movie-view">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>{{ $movie->title }}
                    <span class="text-muted pull-right">{{ $movie->year }}</span></h1>
                </div>

                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-3">

                        @if(!empty($movie->poster))
                            <div class="img">
                                <img src="{{ $movie->poster }}" alt="{{ str_replace('"', '', $movie->title) }}">
                                
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $movie->imdb_rating*10 }}%;">
                                        {{ $movie->imdb_rating }}/10
                                    </div>
                                </div>

                                <div class="btn-group btn-group-justified">
                                    <a href="https://twitter.com/intent/tweet?text={{ $tweet_text }}" target="_blank" class="btn btn-twitter btn-sm"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?t={{ $fb_text }}&u={{ $current_url }}" target="_blank" class="btn btn-facebook btn-sm"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                </div> <!-- .btn-group -->
                            </div> <!-- .img -->
                        @endif

                        </div> <!-- .col-md-3 -->
                        <div class="col-md-5">

                            @if(!empty($movie->plot))
                                {{ $movie->plot }}
                            @endif

                            <hr>

                            <div class="btn-group btn-group-justified" role="group" aria-label="Buttons">
                                @if(Auth::guest())
                                    <a href="/login" class="btn btn-primary">Login to Add</a>
                                @else
                                    @if(Auth::user()->movies->contains($movie->id))
                                        @if(Auth::user()->movies->find($movie->id)->pivot->has_watched)
                                            <a href="javascript:void(0);" class="btn btn-warning btn-mark-watched" data-is-watched="1" data-id="{{ $movie->id }}">Mark as not-watched</a>
                                        @else
                                            <a href="javascript:void(0);" class="btn btn-info btn-mark-watched" data-is-watched="0" data-id="{{ $movie->id }}">Mark as watched</a>
                                        @endif
                                        <a href="javascript:void(0);" class="btn btn-danger btn-add add-mark-watched" data-on-list="1" data-id="{{ $movie->id }}">Remove from your list</a>
                                    @else
                                        <a href="javascript:void(0);" class="btn btn-success btn-add add-mark-watched" data-on-list="0" data-id="{{ $movie->id }}">Add to your list</a>
                                    @endif
                                @endif
                            </div>
                        
                        </div> <!-- .col-md-5 -->
                        <div class="col-md-4">
                            <div class="ratings">
                                <span class="label label-warning">IMDb {{ $movie->imdb_rating }}</span>
                                @if(!empty($movie->metascore) && strtoupper($movie->metascore) != 'N/A')
                                    <span class="label label-success">Meta Score {{ $movie->metascore }}</span>
                                @endif
                                @if(!empty($movie->tomato_rating) && strtoupper($movie->tomato_rating) != 'N/A')
                                    <span class="label label-danger">Rotten Tomatoes {{ $movie->tomato_rating }}</span>
                                @endif
                            </div> <!-- .ratings -->

                            <dl class="dl-horizontal">
                                @if(!empty($movie->released) && strtoupper($movie->released) != 'N/A')
                                    <dt>Release Date</dt>
                                    <dd>{{ $movie->released }}</dd>
                                @endif
                                
                                @if(!empty($movie->runtime) && strtoupper($movie->runtime) != 'N/A')
                                    <dt>Runtime</dt>
                                    <dd>{{ $movie->runtime }}mins</dd>
                                @endif
                                
                                @if(!empty($movie->genre) && strtoupper($movie->genre) != 'N/A')
                                    <dt>Genre</dt>
                                    <dd>{{ $movie->genre }}</dd>
                                @endif
                                
                                @if(!empty($movie->actors) && strtoupper($movie->actors) != 'N/A')
                                    <dt>Starring</dt>
                                    <dd>{{ $movie->actors }}</dd>
                                @endif
                                
                                @if(!empty($movie->director) && strtoupper($movie->director) != 'N/A')
                                    <dt>Directed By</dt>
                                    <dd>{{ $movie->director }}</dd>
                                @endif
                                
                                @if(!empty($movie->writer) && strtoupper($movie->writer) != 'N/A')
                                    <dt>Written By</dt>
                                    <dd>{{ $movie->writer }}</dd>
                                @endif
                                
                                @if(!empty($movie->country) && strtoupper($movie->country) != 'N/A')
                                    <dt>Country</dt>
                                    <dd>{{ $movie->country }}</dd>
                                @endif
                                
                                @if(!empty($movie->awards) && strtoupper($movie->awards) != 'N/A')
                                    <dt>Awards</dt>
                                    <dd>{{ $movie->awards }}</dd>
                                @endif
                                
                                @if(!empty($movie->dvd) && strtoupper($movie->dvd) != 'N/A')
                                    <dt>Released to DVD</dt>
                                    <dd>{{ $movie->dvd }}</dd>
                                @endif
                                
                                @if(!empty($movie->production) && strtoupper($movie->production) != 'N/A')
                                    <dt>Prodction</dt>
                                    <dd>{{ $movie->production }}</dd>
                                @endif
                                
                                @if(!empty($movie->box_office) && strtoupper($movie->box_office) != 'N/A')
                                    <dt>Box Office</dt>
                                    <dd>{{ $movie->box_office }}</dd>
                                @endif
                                
                                @if(!empty($movie->rated) && strtoupper($movie->rated) != 'N/A')
                                    <dt>Rated</dt>
                                    <dd>{{ $movie->rated }}</dd>
                                @endif
                            </dl>

                            <div class="btn-group btn-group-justified">
                                @if(!empty($movie->imdb_id))
                                    <a href="https://www.imdb.com/title/{{ $movie->imdb_id }}" target="_blank" class="btn btn-info btn-sm">IMDb</a>
                                @endif
                                @if(!empty($movie->tomato_url) && strtoupper($movie->tomato_url) != 'N/A')
                                    <a href="{{ $movie->tomato_url }}" target="_blank" class="btn btn-info btn-sm">Rotten Tomatoes</a>
                                @endif
                                @if(!empty($movie->website) && strtoupper($movie->website) != 'N/A')
                                    <a href="{{ $movie->website }}" target="_blank" class="btn btn-info btn-sm">Official Website</a>
                                @endif
                            </div> <!-- .btn-group -->
                        </div> <!-- .col-md-4 -->
                    </div> <!-- .row -->
                </div> <!-- .panel-body -->
            </div> <!-- .panel -->
        </div> <!-- .col-md-12 -->        
    </div> <!-- .row -->
@endsection

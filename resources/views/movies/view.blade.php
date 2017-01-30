@extends('layouts.app')

@section('title', $movie->title)
@section('meta_description', 'Add '.$movie->title.' to your must-watch list and keep it bookmarked.')

@section('content')
    <div class="row movie-view">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $movie->title }}
                    <span class="text-muted pull-right">{{ $movie->year }}</span>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-3">

                        @if(!empty($movie->poster))
                            <div class="img pull-left">
                                <img src="{{ $movie->poster }}" alt="{{ str_replace('"', '', $movie->title) }}">
                            </div> <!-- .img -->
                        @endif

                        </div> <!-- .col-md-4 -->
                        <div class="col-md-5">

                            @if(!empty($movie->plot))
                                {{ $movie->plot }}
                            @endif

                            <hr>

                            <div class="btn-group" role="group" aria-label="Buttons">
                                @if(Auth::guest())
                                    <a href="/login" class="btn btn-primary">Login to Watch</a>
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
                        
                        </div> <!-- .col-md-4 -->
                        <div class="col-md-4">
                            <div class="ratings">
                                <span class="label label-warning">IMDb {{ $movie->imdb_rating }}</span>
                                <span class="label label-success">Meta Score {{ $movie->metascore }}</span>
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
                                    <dd>${{ $movie->box_office }}</dd>
                                @endif
                                
                                @if(!empty($movie->rated) && strtoupper($movie->rated) != 'N/A')
                                    <dt>Rated</dt>
                                    <dd>{{ $movie->rated }}</dd>
                                @endif
                            </dl>
                        </div> <!-- .col-md-4 -->

                    <?php // dd($movie); ?>

                </div> <!-- .panel-body -->
            </div> <!-- .panel -->
        </div> <!-- .col-md-12 -->        
    </div> <!-- .row -->
@endsection

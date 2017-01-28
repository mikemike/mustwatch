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

                    @if(!empty($movie->poster))
                        <div class="img pull-left">
                            <img src="{{ $movie->poster }}" alt="{{ str_replace('"', '', $movie->title) }}">
                        </div> <!-- .img -->
                    @endif

                    @if(!empty($movie->plot))
                        {{ $movie->plot }}
                    @endif

                    <div class="btn-group pull-right" role="group" aria-label="Buttons">
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

                </div> <!-- .panel-body -->
            </div> <!-- .panel -->
        </div> <!-- .col-md-12 -->        
    </div> <!-- .row -->
@endsection

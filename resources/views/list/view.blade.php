@extends('layouts.app')

@section('title', 'Your Must Watch List')
@section('meta_description', 'Your Must Watch list')

@section('content')
    <div class="row your-list">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Your Must Watch List</div>
                <div class="panel-body">

                    <div class="filters">
                        <button data-filter="*" class="btn btn-sm btn-success disabled">All</button>
                        @foreach($filters as $filter)
                            <button data-filter="{{ str_slug($filter) }}" class="btn btn-sm btn-info">{{ $filter }}</button>
                        @endforeach
                    </div> <!-- .filters -->

                    <div id="results">
                        <div class="row is-flex">
                        @foreach($movies as $movie)
                            <div class="col-md-2 @foreach(explode(', ', $movie->genre) as $genre) {{ str_slug($genre) }} @endforeach">
                                <div class="movie">
                                    <a href="/title/{{ $movie->slug }}/{{ $movie->id }}"><img src="{{ $movie->poster }}" class="poster" onerror="imgError(this);"></a>
                                    <a href="/title/{{ $movie->slug }}/{{ $movie->id }}"><h2>{{ $movie->title }}</h2></a>
                                    <p class="text-muted">{{ $movie->type }}</p>
                                    @if(Auth::guest()) {
                                        <p class="btn-area"><a href="/login" class="btn btn-primary btn-sm btn-block">Login to Add</a></p>
                                    @else
                                        <p class="btn-area">
                                            @if($movie->pivot->has_watched)
                                                <a href="javascript:void(0);" class="btn btn-warning btn-sm btn-block btn-mark-watched" data-is-watched="1" data-id="{{ $movie->id }}">Mark as not-watched</a>
                                            @else
                                                <a href="javascript:void(0);" class="btn btn-info btn-sm btn-block btn-mark-watched" data-is-watched="0" data-id="{{ $movie->id }}">Mark as watched</a>
                                            @endif
                                            <a href="javascript:void(0);" class="btn btn-danger btn-sm btn-block btn-add" data-on-list="1" data-id="'+ data.movies[i].id +'">Remove from your list</a>
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

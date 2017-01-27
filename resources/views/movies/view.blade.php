@extends('layouts.app')

@section('title', $movie->title)
@section('meta_description', 'Add '.$movie->title.' to your must-watch list and keep it bookmarked.')

@section('content')
    <div class="row movie-view">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $movie->title }}</div>
                <div class="panel-body">

                    @if(!empty($movie->poster))
                        <div class="img pull-left">
                            <img src="{{ $movie->poster }}" alt="{{ str_replace('"', '', $movie->title) }}">
                        </div> <!-- .img -->
                    @endif

                    @if(!empty($movie->plot))
                        {{ $movie->plot }}
                    @endif

                </div> <!-- .panel-body -->
            </div> <!-- .panel -->
        </div> <!-- .col-md-12 -->        
    </div> <!-- .row -->
@endsection

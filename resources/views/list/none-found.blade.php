@extends('layouts.app')

@section('title', 'No movies added')
@section('meta_description', 'Sorry but you have no movies added yet.')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <p>Sorry, you don't have any movies added.  Why not try a <a href="{{ route('search') }}">search</a>?</p>

            <p><a href="{{ route('search') }}" class="btn btn-primary">Search</a></p>

        </div> <!-- .col-md-12 -->        
    </div> <!-- .row -->
@endsection

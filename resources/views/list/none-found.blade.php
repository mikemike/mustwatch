@extends('layouts.app')

@section('title', 'No movies added')
@section('meta_description', 'Sorry but you have no movies added yet.')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>{{ $user->name }} Must Watch List</h1>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <p>Sorry, but there are no movies added.  Why not try a <a href="{{ route('search') }}">search</a>?</p>                    

                    <p><a href="{{ route('search') }}" class="btn btn-primary">Search</a></p>            
                </div>
            </div>

        </div> <!-- .col-md-12 -->        
    </div> <!-- .row -->
@endsection

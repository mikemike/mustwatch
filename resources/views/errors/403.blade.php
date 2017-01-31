@extends('layouts.app')

@section('title', 'Oops - Error')
@section('meta_description', 'Error.  404')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Sorry!  403 - Error</h1>
                </div>
                <div class="panel-body">
                    <p>
                        Sorry, we can't find that page :(
                    </p>

                    <p>
                        If you believe this is a problem, please 
                        <a href="{{ route('contact') }}">get in touch</a>.
                    </p>
                </div>
            </div>
        </div>
@endsection
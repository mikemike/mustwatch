@extends('layouts.app')

@section('title', 'Contact '.config('app.name'))
@section('meta_description', 'Get in touch with '. config('app.name') .' via email.')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Contact Us</h1>
                </div>
                <div class="panel-body">

                    <p>
                        To get in touch just drop us an email: <br>
                        <a href="mailto:info@mustwatch.tv">info@mustwatch.tv</a>
                    </p>

                    <p>
                        We usually respond same day.
                    </p>

                </div> <!-- .panel-body -->
            </div> <!-- .panel -->

        </div> <!-- .col-md-12 -->        
    </div> <!-- .row -->
@endsection

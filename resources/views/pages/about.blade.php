@extends('layouts.app')

@section('title', 'About '.config('app.name'))
@section('meta_description', 'What is '. config('app.name') .' how do you use it and more.')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>About {{ config('app.name') }}</h1>
                </div>
                <div class="panel-body">

                    <p>
                        {{ config('app.name') }} is an online tool to track those movies and TV
                        shows that you really want to watch. 
                    </p>

                    <p>
                        Using {{ config('app.name') }} is easy, just <a href="{{ route('search')}}">search</a>
                        for the film or TV show you're looking for and then add it to your list.  You'll 
                        need an <a href="{{ route('login') }}">account</a> to get started. 
                    </p>

                    <p>
                        Once you find a film or TV show, just add it to your list by pressing the button.
                        Once you've seen it, be sure to mark it as 'Watched', that way you'll be able to keep 
                        track of what you have and haven't seen.  We will be adding features that work
                        with the "Watched" button, such as (optional) automatic social sharing, a stats dashboard
                        and movie/TV show recommendation based of what you enjoy watching.
                    </p>

                    <a name="faq"></a>
                    <h2>FAQs</h2>

                    <h3>How much is it?</h3>
                    <p>
                        Free, forever.
                    </p>

                    <h3><em>XYZ</em> movie or TV show isn't listed, why not?!</h3>
                    <p>
                        We get our data from a few sources, which are nearly always up-to-date, including non-released
                        titles.  So if the TV show or movie you're looking for isn't there then it might be 
                        known as something else (titles are often named differently in other countries - 
                        <a href="http://harrypotter.wikia.com/wiki/Harry_Potter_and_the_Philosopher's_Stone" target="_blank">Harry Potter is a good example of this</a>). 
                        If you are certain we are missing your TV show or film then please get in touch.
                    </p>

                    <h3>How can I delete my account?</h3>
                    <p>
                        Just get in touch with us and we'll get it removed.
                    </p>

                    <h3>Can you add <em>XYZ</em> feature?</h3>
                    <p>
                        We'll do our best, send your suggestions to us and we'll see what we can do.
                    </p>

                </div> <!-- .panel-body -->
            </div> <!-- .panel -->

        </div> <!-- .col-md-12 -->        
    </div> <!-- .row -->
@endsection

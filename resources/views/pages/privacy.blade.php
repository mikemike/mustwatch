@extends('layouts.app')

@section('title', 'Privacy and Cookie Policy')
@section('meta_description', 'Privacy and cookie policy.')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Privacy &amp; Cookie Policy</h1>
                </div>
                <div class="panel-body">

                    <h2>Cookies</h2>
                    <h3>
                        What is a cookie?
                    </h3>
                    <p>
                        A cookie is a small file that is created by a website and stored on your computer. 
                        This little file contains a small amount of data that helps the website do 
                        various tasks.
                    </p>

                    <p>
                        We use cookies for a few different things, which include:
                    </p>
                    <ul>
                        <li>Session handling - eg. keeping you logged in to the website</li>
                        <li>
                            Analytics - we use Google Analytics to track what pages are looked 
                            at on our website.  Nothing personally identifiable is sent to Google. 
                        </li>
                    </ul>

                    <p>
                        You aren't forced to use cookies in order to use this website.  You can 
                        set your browser to block cookies from being created.  Doing so will limit 
                        your functionality, though. 
                    </p>

                    <h2>Privacy Policy</h2>
                    <p>
                        Your privacy online is important, and we take it seriously. 
                    </p>
                    <p>
                        To sign up we'll need 3 pieces of information from you; your name, your email address 
                        and a password.  This data is then stored securely on our database, which cannot 
                        be accessed publically. 
                    </p>
                    <p>
                        We <b>do not</b> sell any of your details under any circumstances.
                    </p>
                    <p>
                        Although not currently implemented, we may use your email address in the future 
                        to let you know about new features implemented.  These emails will be very 
                        infrequent, and you'll be able to opt out whenever you want.
                    </p>

                </div> <!-- .panel-body -->
            </div> <!-- .panel -->

        </div> <!-- .col-md-12 -->        
    </div> <!-- .row -->
@endsection

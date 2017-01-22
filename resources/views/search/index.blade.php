@extends('layouts.app')

@section('title', 'Search')

@section('meta_description')
    Search for movies and TV shows on {{ config('app.name') }}.
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Search</div>
                <div class="panel-body">

                    <form class="" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="q" class="control-label">Search</label>
                            <input id="q" type="text" class="form-control" name="q" value="{{ old('q') }}" placeholder="Shawshank Redemption or Game of Thrones" autocomplete="off" data-provide="typeahead" required autofocus>

                            @if ($errors->has('q'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('q') }}</strong>
                                </span>
                            @endif
                        </div>                        
                    </form>

                    <div id="results"></div>

                </div>
            </div>

        </div> <!-- .col-md-12 -->
        
    </div> <!-- .row -->
@endsection

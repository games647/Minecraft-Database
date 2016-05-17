@extends('parent')

@section('title', 'Player not found')

@section('description', 'The requested player cannot be found')

@section('content')
        <div class="container">
            <div class="allContent">
                <h1>Player not found</h1>

                <p>Do you want to submit him?</p>
                <a href="/player/add/{{ $uuid }}" class="btn btn-default" rel="noindex">Submit</a>
            </div>
        </div>

@endsection
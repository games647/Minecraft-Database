@extends('parent')

@section('title', 'Server not found')

@section('description', 'The requested server address cannot be found')

@section('content')
        <div class="container">
            <div class="allContent">
                <h1>Server not found</h1>

                <p>Do you want to submit it?</p>
                <a href="/server/add/{{ $address }}" class="btn btn-default">Submit</a>
            </div>
        </div>

@endsection
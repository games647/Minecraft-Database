@extends('parent')

@section('title', 'Search in Database')

@section('keywords', "search server database")

@section('description', "Search servers in the Database")

@push('meta')
    <meta name="robots" content="noindex,nofollow">
@endpush

@section('content')
        <div class="container">
            <div class="allContent">
                <h1>Search</h1>
@if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
@foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
@endforeach
                    </ul>
                </div>
@endif
                <form action="{{ url("search") }}" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control dark-background-input" name="search" placeholder="Search"
                               value="{{ $keyword or '' }}">
                        {!! csrf_field() !!}
                        <span class="input-group-btn">
                            <button class="btn btn-default dark-background" type="submit">
                                <span id="search_icon" class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </button>
                        </span>
                    </div>
                </form>

@if(isset($servers) && count($servers) > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th class="serverIcon">Rank</th>
                        <th class="serverInfo">Server</th>
                        <th class="players">Players</th>
                    </tr>
                    </thead>
                    <tbody>
                        @each('serverentry', $servers, 'server')

                    </tbody>
                </table>
@endif

            </div>
        </div>
@endsection
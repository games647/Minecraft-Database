@extends('parent')

@section('title', 'Search in Database')

@section('keywords', "search server database")

@section('description', "Search Server in the Database")

@section('content')
    <div class="container">
        <div class="allContent">
            <h1>Search</h1>
            <form action="{{ url("search") }}" method="post">
                {!! csrf_field() !!}
                <div class="input-group">
                    <input type="text" class="form-control dark-background-input" name="search" placeholder="Search" value="{!! $keyword !!}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <span class="input-group-btn">
                        <button class="btn btn-default dark-background" type="submit"><span id="search_icon" class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </span>
                </div>
            </form>

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
        </div>
    </div>


@endsection
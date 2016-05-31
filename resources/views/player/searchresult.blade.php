@extends('parent')

@section('title', 'Search in Player Database')

@section('keywords', "search, player, database")

@section('description', "Search Players in the Database")

@section('content')
        <div class="container">
            <div class="allContent">
                <a href="/player" class="back-arrow">
                    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true">

                    </span> Back to Database</a>
                <h1>Search Players</h1>
@if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
@foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
@endforeach
                    </ul>
                </div>
@endif
                <form action="{{ secure_url("/player/search") }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control dark-background-input" name="search" placeholder="Search"
                           value="{{ $keyword or '' }}">
                        <span class="input-group-btn">
                            <button class="btn btn-default dark-background" type="submit">
                                <span id="search_icon" class="glyphicon glyphicon-search" aria-hidden="true">

                                </span>
                            </button>
                        </span>
                    </div>
                </form>
@if(isset($players) && count($players) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th class="serverIcon">Rank</th>
                            <th class="serverInfo">Server</th>
                            <th class="players">Players</th>
                        </tr>
                    </thead>
                    <tbody>
                    @each('player.playerentry', $players, 'player')

                    </tbody>
                </table>
@endif

            </div>
        </div>

@endsection
@extends('parent')

@section('title', 'Playerlist page ')

@section('description', "A Minecraft multiplayer player liste page: ")

@push('opengraph')
{{-- Facebook Open Graph --}}
        <meta property="og:title" content="Playerlist page:" />
        <meta property="og:description" content="A Minecraft player list to find your favorite players"/>
        <meta property="og:image" content="{{ secure_url("/favicon.jpg") }}" />
        <meta property="og:url" content="{{ URL::current() }}" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="Minecraft-Database" />

{{-- Twitter --}}
        <meta name="twitter:card" content="summary" />
@endpush

@section('content')
        <div class="container">
            <div class="allContent">
                <div id="heading" class="col-sm-8">
                    <h1>Minecraft Database - Playerlist</h1>
                </div>
                <div id="serach_container" class="col-sm-4">
                    <form action="{{ secure_url("/player/search") }}" method="GET" id="search">
                        <div class="input-group">
                            <input type="text" class="form-control dark-background-input" name="search"
                                   placeholder="Search">
                            <span class="input-group-btn">
                                <button class="btn btn-default dark-background" type="submit">
                                    <span id="search_icon" class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                </button>
                            </span>
                        </div><!-- /input-group -->
                    </form>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="playerIcon">Head</th>
                            <th class="playerInfo">Player</th>
                        </tr>
                    </thead>
                    <tbody>
                    @each('player.playerentry', $players, 'player')

                    </tbody>
                </table>
                {!! $players->render() !!}
            </div>
        </div>

@endsection

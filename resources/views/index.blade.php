@extends('parent')

@section('title', 'Serverlist page ' . $servers->currentPage())

@section('description', "A Minecraft multiplayer server liste page: " . $servers->currentPage())

@push('opengraph')
        <meta property="og:title" content="Serverlist page: {{ $servers->currentPage() }}" />
        <meta property="og:description" content="A Minecraft multiplayer server list to find your favorite servers"/>
        <meta property="og:image" content="{{ url("/favicon.ico") }}" />
        <meta property="og:url" content="{{ URL::current() }}" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="Minecraft-Database" />
@endpush

@section('content')
        <div class="container">
            <div class="allContent">
                <div id="heading" class="col-sm-8">
                    <h1>Minecraft Database - Serverlist</h1>
                </div>
                <div id="serach_container" class="col-sm-4">
                    <form action="{{ url("search") }}" method="POST" id="search">
                        <div class="input-group">
                            <input type="text" class="form-control dark-background-input" name="search"
                                   placeholder="Search">
                            {!! csrf_field() !!}
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
                            <th class="serverIcon">Rank</th>
                            <th class="serverInfo">Server</th>
                            <th class="players">Players</th>
                        </tr>
                    </thead>
                    <tbody>
                        @each('serverentry', $servers, 'server')

                    </tbody>
                </table>
                {!! $servers->render() !!}
            </div>
        </div>
@endsection

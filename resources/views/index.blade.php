@extends('parent')

@section('title', 'Serverlist')

@section('content')
        <div class="container">
            <div class="allContent">
                <h1>Minecraft Database - Serverlist</h1>
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

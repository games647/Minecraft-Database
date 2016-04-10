@extends('parent')

@section('title', 'Serverlist')

@section('content')
        <div class="container">
            <div class="allContent">
                <h1>Minecraft Database - Serverlist</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th width="10%">Rank</th>
                            <th width="70%">Server</th>
                            <th width="20%">Players</th>
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

@extends('player.parent')

@section('title', $player->name . " - Minecraft Player")

@section('keywords', $player->name . ", " . $player->uuid . ", minecraft, player")

@section('description', "minecraft player: " . $player->name . " uuid: " . $player->uuid)

@push('opengraph')
{{-- Facebook Open Graph --}}
<meta property="og:title" content="{{ $player->name }} - Minecraft player page" />
<meta property="og:description" content="Minecraft Player: {{ $player->name }}, UUID: {{ $player->uuid }}" />
<meta property="og:url" content="{{ URL::current() }}" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="Minecraft-Database" />

{{-- Twitter --}}
<meta name="twitter:card" content="summary" />
@endpush

        <!--Images-->
@if (file_exists(public_path() . "/img/favicons/" . $player->uuid . ".png"))
    @push('opengraph')
    <meta property="og:image" content="{{ url("/img/favicons/" . $player->uuid . ".png") }}" />
    @endpush
@else
    @push('opengraph')
    <meta property="og:image" content="{{ url("/img/favicons/default_head.png") }}" />
    @endpush
@endif

@section('content')
    <div class="container">
        <div class="allContent">
            <a href="/player" class="back-arrow"><span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span> Back to Database</a>
            <h1>
                @if ($player->online)
                    <span class="online motd">{{ $player->name }}</span>
                @else
                    <span class="offline motd">{{ $player->name }}</span>
                @endif
                - Player Page
            </h1>

            <div class="playerInfo">
                @if (file_exists(public_path() . "/img/favicons/" . $player->uuid . ".png"))
                    <img class="playerIcon" src="/img/favicons/{{ $player->uuid }}.png" alt="Player Head"/>
                @else
                    <img class="playerIcon" src="/img/favicons/head_default.png" alt="{{ $player->name }} Head"/>
                @endif
                <table class="table">
                    <tr>
                        <th>Username:</th>
                        <td class="playerName">{{ $player->name }}</td>
                    </tr>
                    <tr>
                        <th>UUID: </th>
                        <td class="uuid">
                            {!! $player->uuid !!}
                        </td>
                    </tr>
                    <tr>
                        <th>Status: </th>
                        <td>
                            @if ($player->online)
                                <span class="label label-success">Online</span>
                            @elseif(!is_bool($player->online))
                                <span class="label label-info">Unknown</span>
                            @else
                                <span class="label label-danger">Offline</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

@endsection
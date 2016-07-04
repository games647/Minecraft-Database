@extends('parent')

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
        <meta property="og:image" content="{{ secure_url("/img/head/" . $player->uuid . ".png") }}" />
    @endpush
@else
    @push('opengraph')
        <meta property="og:image" content="{{ secure_url("/img/head/default.png") }}" />
    @endpush
@endif

@section('content')
        <div class="container">
            <div class="allContent">
                <a href="/player" class="back-arrow"><span class="glyphicon glyphicon-triangle-left" aria-hidden="true">
                    </span> Back to Database</a>
                <h1>
@if ($player->online)
                    <span class="online motd">{{ $player->name }}</span>
@else
                    <span class="offline motd">{{ $player->name }}</span>
@endif
                    - Player Page
                </h1>

                <div class="playerInfo">
@if (file_exists(public_path() . "/img/head/" . $player->uuid . ".png"))
                    <img class="playerIcon" src="/img/head/{{ $player->uuid }}.png" alt="Player Head"/>
@else
                    <img class="playerIcon" src="/img/head/default.png" alt="Default Head"/>
@endif
                    <table class="table">
                        <tr>
                            <th>Username:</th>
                            <td class="playerName">{{ $player->name }}</td>
                        </tr>
                        <tr>
                            <th>UUID: </th>
                            <td class="uuid">
                                {{ $player->uuid }}
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
                        <tr>
                            <th>Skin: </th>
                            <td>
                                @if($skinsize[0] != null && $skinsize[1] != null)
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width: 120px; padding-left: 10px; padding-bottom: 10px;">
                                            <img style="margin: 0 0 0 20px; padding: 0;" src="{{ url("/img/skin/$player->uuid.png") }}">
                                        </td>
                                        <td style="padding-left: 110px;">
                                            <img style="width: 200px; margin: 0px 90px 0px 0px;" src="{{ url("/img/skin/raw/$player->uuid.png") }}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><a href="{{ url("/img/skin/$player->uuid.png") }}" download="{{ $player->name }} Image.png" class="btn btn-default">Download Skin Image</a></td>
                                        <td><a href="{{ url("/img/skin/raw/$player->uuid.png") }}" download="{{ $player->name }}.png" style="width: 200px;" class="btn btn-default">Download Raw Skin</a></td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ $skinsize[0] }}</p></td>
                                        <td><p>{{ $skinsize[1] }}</p></td>
                                    </tr>
                                    @else
                                        <p>This Player is using the Standard Skin</p>
                                    @endif
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

@endsection
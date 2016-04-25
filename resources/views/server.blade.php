@extends('parent')

@section('title', $server->address . " - Minecraft Server")

@section('keywords', $server->address . ", " . $server->address . " motd,")

@section('description', "minecraft server: " . $server->address . " description: " . $server->getPlainMotd())

@push('opengraph')
{{-- Facebook Open Graph --}}
        <meta property="og:title" content="{{ $server->address }} - Minecraft server page" />
        <meta property="og:description" content="{{ $server->getPlainMotd() }}" />
        <meta property="og:url" content="{{ URL::current() }}" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="Minecraft-Database" />

{{-- Twitter --}}
        <meta name="twitter:card" content="summary" />
@endpush

<!--Images-->
@if (file_exists(public_path() . "/img/favicons/" . $server->address . ".png"))
    @push('opengraph')
        <meta property="og:image" content="{{ url("/img/favicons/" . $server->address . ".png") }}" />
    @endpush
@else
    @push('opengraph')
        <meta property="og:image" content="{{ url("/img/favicons/default.png") }}" />
    @endpush
@endif

@section('content')
        <div class="container">
            <div class="allContent">
                <h1>
@if ($server->online)
                    <span class="online motd">{{ $server->address }}</span>
@else
                    <span class="offline motd">{{ $server->address }}</span>
@endif
                    - Server Page
                </h1>

                <div class="serverInfo">
@if (file_exists(public_path() . "/img/favicons/" . $server->address . ".png"))
                    <img class="serverIcon" src="/img/favicons/{{ $server->address }}.png" alt="Server favicon"/>
@else
                    <img class="serverIcon" src="/img/favicons/default.png" alt="{{ $server->address }} favicon"/>
@endif
                    <table class="table">
                        <tr>
                            <th>Address:</th>
                            <td class="serverName">{{ $server->address }}</td>
                        </tr>
                        <tr>
                            <th>Motd: </th>
                            <td class="motd">
                                {!! $server->getHtmlMotd() !!}
                            </td>
                        </tr>
                        <tr>
                            <th>Status: </th>
                            <td>
@if ($server->online)
                                <span class="label label-success">Online</span>
@else
                                <span class="label label-danger">Offline</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Onlinemode: </th>
                            <td>
@if (is_null($server->onlinemode))
                                <span class="label label-info">Unknown</span>
@elseif ($server->onlinemode)
                                <span class="label label-success">Premium</span>
@else
                                <span class="label label-danger">Cracked</span>
@endif
                            </td>
                        </tr>
                        <tr>
                            <th>Version: </th>
                            <td>
                                <span class="label label-info">{{ $server->version }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Players: </th>
                            <td>
@if ($server->online)
                                <div class="online">{{ $server->players }} / {{ $server->maxplayers }}</div>
@else
                                <div class="offline">0 / {{ $server->maxplayers }}</div>
@endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

@endsection
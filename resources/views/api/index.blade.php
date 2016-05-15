@extends('api.parent')

@section('title', 'Minecraft-Database API')

@section('description', "Minecraft-Database API")

@push('opengraph')
{{-- Facebook Open Graph --}}
<meta property="og:title" content="Minecraft-Database API" />
<meta property="og:description" content="Minecraft-Database API"/>
<meta property="og:image" content="{{ url("/favicon.jpg") }}" />
<meta property="og:url" content="{{ URL::current() }}" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="Minecraft-Database" />

{{-- Twitter --}}
<meta name="twitter:card" content="summary" />
@endpush

@section('content')
    <h3>API URLs</h3>
    <a href="/api/server/">/server/</a><br>
    <a href="/api/player/">/player/</a><br>
    <a href="#">/plugin/[plugin-name]/usage</a><br><br>
    <p>Reference: <a href="https://github.com/games647/Minecraft-Database/wiki/API">https://github.com/games647/Minecraft-Database/wiki/API</a></p>
@endsection

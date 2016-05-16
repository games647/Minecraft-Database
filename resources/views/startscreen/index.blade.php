@extends('startscreen.parent')

@section('title', 'Serverlist page ')

@section('description', "A Minecraft multiplayer server liste page: ")

@push('opengraph')
{{-- Facebook Open Graph --}}
<meta property="og:title" content="Serverlist page:" />
<meta property="og:description" content="A Minecraft multiplayer server list to find your favorite servers"/>
<meta property="og:image" content="{{ url("/favicon.jpg") }}" />
<meta property="og:url" content="{{ URL::current() }}" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="Minecraft-Database" />

{{-- Twitter --}}
<meta name="twitter:card" content="summary" />
@endpush

@push('style')
    <style>
        @font-face { font-family: 'minecraft'; src: url("{!! url("minecraft.ttf") !!}") format('truetype'); }

        html {
            width: 99%;
        }

        body {
            background: url("{!! url("/img/start_background.png") !!}") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            padding-bottom: 0!important;
        }

        #startscreen_headline
        {
            font-family: "source_sans", "Lucida Grande", "Lucida Sans", sans-serif;
            height: 40px;
            width: 1050px;
            text-align: center;
            margin: 8% auto 0;
        }

        #startscreen_headline_minecraft
        {
            font-family: minecraft, serif;
        }

        .startscreen_img
        {
            height: 250px !important;
            width: auto;
            padding: 10px 10px 0;
        }

        .thumb_container
        {
            top: 50%;
            position: relative;
        }

        .main_container
        {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
@endpush

@section('content')
    <div class="main"
    <div class="row thumb_container">
        <div class="col-md-12">
            <h1 id="startscreen_headline"><span id="startscreen_headline_minecraft">Minecraft</span>Database</h1>
        </div>
    </div>
    <div class="container main_container">
        <div class="row">
            <div class="col-md-6">
                <div class="thumbnail">
                    <img src="{!! url('/img/Skin.png') !!}" alt="..." class="startscreen_img">
                    <div class="caption">
                        <h3><a href="/player">Player Database</a></h3>
                        <p>Das ist ein Text</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="thumbnail">
                    <img src="{!! url("/img/crafting_table.png") !!}" alt="..." class="startscreen_img">
                    <div class="caption">
                        <h3><a href="/server">Server Database</a></h3>
                        <p>Das ist ein Text</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

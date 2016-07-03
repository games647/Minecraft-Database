<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Select the page you want to visit"/>
        <meta name="keywords"
              content="@yield('keywords', '') minecraft multiplayer serverlist, minecraft database, minecraft server"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

{{-- Facebook Open Graph --}}
        <meta property="og:title" content="Minecraft Database Startscreen" />
        <meta property="og:description" content="Select the page you want to visit"/>
        <meta property="og:image" content="{{ secure_url("/favicon.jpg") }}" />
        <meta property="og:url" content="{{ URL::current() }}" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="Minecraft-Database" />

{{-- Twitter --}}
        <meta name="twitter:card" content="summary" />

        <title>Startscreen | Minecraft Database</title>
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>
        <link rel="stylesheet" href="/css/app.css"/>
    </head>
    <body class="startscreen">
        <div class="row thumb_container">
            <div class="col-md-12">
                <h1 id="startscreen_headline">
                    <span id="startscreen_headline_minecraft">
                        Minecraft-Database
                    </span>
                </h1>
            </div>
        </div>
        <div class="container main_container">
            <div class="row">
                <div class="col-md-6">
                    <div class="thumbnail">
                        <img src="{{ secure_url('/img/Skin.png') }}" alt="Player Database" class="startscreen_img">
                        <div class="caption">
                            <h3>
                                <a href="/player">
                                    Player Database
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="thumbnail">
                        <img src="{{ secure_url("/img/crafting_table.png") }}" alt="Server Database" class="startscreen_img">
                        <div class="caption">
                            <h3>
                                <a href="/server">
                                    Server Database
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-2.2.3.min.js"
                integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
                integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
                crossorigin="anonymous">
        </script>
    </body>
</html>
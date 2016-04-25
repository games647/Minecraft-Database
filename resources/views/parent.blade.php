<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="@yield('description'
              , 'A Minecraft multiplayer server list in order to find your favorite servers')"/>
        <meta name="keywords"
              content="@yield('keywords', '') minecraft multiplayer serverlist, minecraft database, minecraft server"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

@stack('opengraph')
@stack('meta')

        <title>@yield('title') | Minecraft Database</title>
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>
        <link rel="stylesheet" href="/css/app.css"/>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Minecraft Database</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/server/add">Add server</a></li>
                        <li><a href="https://github.com/games647/Minecraft-Database/wiki/API">API</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/privacy">Privacy</a></li>
                        <li><a href="/tos">TOS</a></li>
                        <li><a href="/imprint">Imprint/Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>

@yield('content')

        <div class="container">
            <footer>
                <p>This project is open source | Visit us on
                    <a href="https://github.com/games647/Minecraft-Database">Github</a>
                    - If you like the project please leave a star
                </p>
                <p>
                    This website collects cookies in order to login users and provide security to them. For more details
                    visit the privacy policiy.
                </p>
                <p>Minecraft is copyrighted by Mojang and is not affiliated with this site.</p>
            </footer>
        </div>

        <script src="https://code.jquery.com/jquery-2.2.3.min.js"
            integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous">
        </script>
    </body>
</html>

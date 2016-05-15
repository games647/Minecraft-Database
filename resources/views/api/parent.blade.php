<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="@yield('description'
              , 'Minecraft-Database API')"/>
    <meta name="keywords"
          content="@yield('keywords', '') minecraft multiplayer serverlist, minecraft database, minecraft server, player, player database"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @stack('opengraph')
    @stack('meta')

    <title>@yield('title') | Minecraft Database</title>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>
</head>
<body>
@yield('content')
</body>
</html>

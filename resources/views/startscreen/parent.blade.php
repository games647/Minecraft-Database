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
    @stack('style')
</head>
<body>
@yield('content')
<script src="https://code.jquery.com/jquery-2.2.3.min.js"
        integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous">
</script>
</body>
</html>

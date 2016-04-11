@extends('parent')

@section('title', 'Imprint')

@section('content')
        <div class="container">
            <div class="allContent">
                <h1>Imprint</h1>
                <p>
                    {{env("test")}}
                    <div>
                        {{ env('name', 'name') }} {{ env('lastname', 'lastname') }}
                        <br/>
                        {{ env('street', 'street') }}
                        <br/>
                        {{ env('city', 'city') }}
                        <br/>
                        {{ env('country', 'country') }}
                    </div>

                    <br/>

                    Support: supportcontact [ AT ] . minecraft-database.com
                </p>


                <p>
                    For bugs, suggestions or contributions visit this:
                    <a href="https://github.com/games647/Minecraft-Database/issues">Issue tracker</a>:
                </p>

                <p>
                    Until the server removal process is automatic, please send removal requests to:
                    <br/>
                    removal [ AT ] . minecraft-database.com
                </p>

                <h2>Credits</h2>
                <ul>
                    <li>Website favicon -
                        <a href="https://www.wpclipart.com/terms.html">Public Domain </a>
                        -
                        <a href="https://www.wpclipart.com/computer/icons/database_symbol.png.html">Source</a>
                    </li>
                    <li>Server favicon default -
                        <a href="http://creativecommons.org/licenses/by-nc-nd/4.0/">
                            CC Attribution-Noncommercial-No Derivate 4.0
                        </a>
                        -
                        <a href="http://www.iconarchive.com/show/minecraft-icons-by-chrisl21/Mycelium-icon.html">
                            Source
                        </a>
                    </li>
                    <li>Server favicon default 2 -
                        <a href="https://creativecommons.org/licenses/by/3.0/">
                            Creative Commons (Unported 3.0)
                        </a>
                        -
                        <a href="https://www.iconfinder.com/icons/104823/minecraft_icon">
                            Source
                        </a>
                    </li>
                    <li>Minecraft Font -
                        <a href="http://www.fonts2u.com/minecraft">Freeware </a>
                        -
                        <a href="http://www.fonts2u.com/minecraft">Source</a>
                    </li>
                    <li>Minecraft Colors -
                        <a href="https://github.com/Spirit55555/PHP-Minecraft/blob/master/LICENSE">GPLv3 </a>
                        -
                        <a href="https://github.com/Spirit55555/PHP-Minecraft">Source</a>
                    </li>
                    <li>PHP-Minecraft-Query -
                        <a href="https://github.com/xPaw/PHP-Minecraft-Query/blob/master/LICENSE">MIT </a>
                        -
                        <a href="https://github.com/xPaw/PHP-Minecraft-Query">Source</a>
                    </li>
                </ul>
            </div>
        </div>

@endsection
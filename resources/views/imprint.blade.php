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

                    Support: Support: supportcontact [ AT ] . minecraft-database.com
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
            </div>
        </div>

@endsection
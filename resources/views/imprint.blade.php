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

                    Support: support email
                </p>
            </div>
        </div>

@endsection
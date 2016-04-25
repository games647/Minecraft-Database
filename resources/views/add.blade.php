@extends('parent')

@section('title', 'Add server')

@section('keywords', "add minecraft server")

@push('opengraph')
        <meta property="og:title" content="Add server" />
        <meta property="og:description" content="Add your favorite minecraft server to the database to publish it" />
        <meta property="og:image" content="{{ url("/favicon.ico") }}" />
        <meta property="og:url" content="{{ URL::current() }}" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="Minecraft-Database" />
@endpush

@section('description', "Add your favorite minecraft server to the database to publish it")

@section('content')
        <div class="container">
            <div class="allContent">
                <h1>Add server</h1>
@if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
@foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
@endforeach
                    </ul>
                </div>
@endif

                <form method="POST" action="/server/add">
                    <div class="form-group">
                        <input name="address" type="text" class="form-control" value="{{ $address or '' }}"
                               placeholder="example.minecraft.com" required />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="form-control" />
                    </div>

                    {!! Recaptcha::render() !!}
                </form>
            </div>
        </div>

@endsection

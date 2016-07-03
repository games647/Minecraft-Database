@extends('parent')

@section('title', 'Add player')

@section('keywords', "add minecraft player")

@push('opengraph')
{{-- Facebook Open Graph --}}
        <meta property="og:title" content="Add player" />
        <meta property="og:description" content="Add your minecraft profile to the database" />
        <meta property="og:image" content="{{ secure_url("/favicon.jpg") }}" />
        <meta property="og:url" content="{{ URL::current() }}" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="Minecraft-Database" />

{{-- Twitter --}}
        <meta name="twitter:card" content="summary" />
@endpush

@section('description', "Add your favorite minecraft player to the database")

@section('content')
    <div class="container">
        <div class="allContent">
            <h1>Add player</h1>
@if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
@foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
@endforeach
                    </ul>
                </div>
@endif

            <form method="POST" action="/player/add">
                <div class="form-group">
                    <input name="name" type="text" class="form-control" value="{{ $name or '' }}"
                           placeholder="dinnerbone" required />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="form-control" />
                </div>

                {!! Recaptcha::render() !!}
            </form>
        </div>
    </div>

@endsection

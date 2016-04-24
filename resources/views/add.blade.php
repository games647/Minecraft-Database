@extends('parent')

@section('title', 'Add server')

@section('keywords', "add minecraft server")

@section('description', "Add your favorite minecraft server to the database in order to publish it")

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

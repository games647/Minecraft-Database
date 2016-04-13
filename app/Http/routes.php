<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => ['web']], function () {
    Route::get('/', "ServerController@index");

    Route::get('/server/add/{address}', function($address) {
        return view('add', ['address' => "$address"]);
    });

    Route::get('/server/add', function() {
        return view('add');
    });

    Route::post('/server/add', "ServerController@addServer");

    Route::get('/server/{address}', "ServerController@showServer");

    Route::get('/server', function() {
        return redirect('/');
    });

    //general
    Route::get('/privacy', function() {
        return view('privacy');
    });

    Route::get('/tos', function() {
        return view('tos');
    });

    Route::get('/imprint', function() {
        return view('imprint');
    });
});

//API
Route::group(['prefix' => 'api', 'middleware' => ['api']], function () {
    Route::get('/', function() {
        return App\Server::paginate();
    });

    Route::get('/server/{address}', function($address) {
        return App\Server::whereAddress($address)->first();
    });

    Route::get('/server/{address}/favicon', function($address) {
        return redirect('/public/img/favicon/' . $address);
    });

    Route::get('/server', function() {
        return redirect('/api');
    });
});

Route::get('/secret', function() {
    return PHP_BINARY;
});

Route::get('/.git', function() {
    return "This project is open source. So why don't you just visit: https://github.com/games647/Minecraft-Database";
});
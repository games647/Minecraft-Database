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
    //serverlist
    Route::get('/', "ServerController@index");

    Route::get('/server/add/{address}', function() {
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

Route::get('/.git', function() {
    return "This project is open source. So why don't you just visit: https://github.com/games647/MinecraftDatabase";
});
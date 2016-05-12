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
    Route::get('/', "ServerController@redirectPage");

    Route::get('/server', "ServerController@index");

    Route::get('/server/add/{address?}', "ServerController@getAdd");

    Route::post('/server/add', "ServerController@addServer");

    Route::get('/search/', "SearchController@search");
    Route::get('/server/{address}', "ServerController@showServer");

    //general
    Route::get('/privacy', 'ContactController@privacy');
    Route::get('/tos', 'ContactController@tos');
    Route::get('/imprint', 'ContactController@imprint');
});

//API
Route::group(['prefix' => 'api', 'middleware' => ['api']], function () {
    Route::get('/server', 'ApiController@index');

    Route::get('/server/{address}', 'ApiController@getServer');
    Route::get('/server/{address}/favicon', 'ApiController@getIcon');

    Route::get('/plugin/{pluginName}/usage', 'ApiController@getPluginUsage');

    Route::get('/player/{uuid}', 'ApiController@getPlayerByUUID')
            ->where("uuid", "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}");
    Route::get('/player/{username}', 'ApiController@getPlayerByName')->where("username", "\w{2,16}");

    //todo: rendered skin routes
    Route::get('/skin/{uuid}', 'ApiController@getSkinByUUID')
            ->where("uuid", "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}");
    Route::get('/skin/{name}', 'ApiController@getSkinByName')->where("username", "\w{2,16}");

    Route::get('/stats', 'ApiController@stats');
});

Route::get('/sitemap.xml', 'SitemapController@get');

Route::get('/.git', 'ContactController@git');

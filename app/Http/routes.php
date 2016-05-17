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

    // Index Screen
    Route::get('/', "ServerController@redirectPage");
    Route::get('/start', "BaseController@index");

    // Servers
    Route::get('/server', "ServerController@index");

    Route::get('/server/add/{address?}', "ServerController@getAdd");

    Route::post('/server/add', "ServerController@addServer");

    Route::get('/server/search', "SearchController@searchServer");
    Route::get('/server/{address}', "ServerController@showServer");

    // Players
    Route::get('/player', "PlayerController@index");

    Route::get('/player/add/{uuid?}', "PlayerController@getAdd");

    Route::post('/player/add', "PlayerController@addPlayer");

    Route::get('/player/search', "SearchController@searchPlayer");

    Route::get('/player/{username}', "PlayerController@getPlayerByUsername")->where("username", "\w{2,16}");
    Route::get('/player/{uuid}', "PlayerController@getPlayerByUUID");

    //general
    Route::get('/privacy', 'BaseController@privacy');
    Route::get('/tos', 'BaseController@tos');
    Route::get('/imprint', 'BaseController@imprint');
});

//API
Route::group(['prefix' => 'api', 'middleware' => ['api']], function () {
    // Server
    Route::get('/server', 'ApiController@serverIndex');

    Route::get('/server/{address}', 'ApiController@getServer');
    Route::get('/server/{address}/favicon', 'ApiController@getIcon');

    // Plugin
    Route::get('/plugin/', 'ApiController@getPlugins');
    Route::get('/plugin/{pluginName}/', 'ApiController@getPluginInfo');
    Route::get('/plugin/{pluginName}/usage', 'ApiController@getPluginUsage');

    //Player
    Route::get('/player', 'ApiController@playerIndex');
    Route::get('/player/{username}', 'ApiController@getPlayerByName')->where("username", "\w{2,16}");
    Route::get('/player/{uuid}', 'ApiController@getPlayerByUUID');

    //todo: rendered skin routes
    Route::get('/skin/{name}', 'ApiController@getSkinByName')->where("username", "\w{2,16}");
    Route::get('/skin/{uuid}', 'ApiController@getSkinByUUID');

    Route::get('/stats', 'ApiController@stats');
});

Route::get('/sitemap_server_pages.xml', 'SitemapController@getServerPages');
Route::get('/sitemap_server_index.xml', 'SitemapController@getServerIndex');

Route::get('/.git', 'BaseController@git');

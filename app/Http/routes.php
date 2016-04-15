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
Route::get('/.git', function() {
    return "This project is open source. So why don't you just visit: https://github.com/games647/Minecraft-Database";
});

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

Route::get('/sitemap.xml', function() {
    // create new sitemap object
    /* @var $sitemap Roumen\Sitemap\Sitemap */
    $sitemap = App::make("sitemap");
    if (!$sitemap->isCached()) {
        $servers = \App\Server::orderBy('updated_at', 'desc')->get();

        $sitemap->add(URL::to('/'), collect($servers)->first()->updated_at, '1.0', 'hourly');

        /* @var $server \App\Server */
        foreach ($servers as $server) {
            $address = $server->address;

            $loc = URL::to("/server", $address);
            $lastmod = $server->updated_at;
            $freq = 'daily';

            $images = array();
            if (file_exists(public_path() . "/img/favicons/$address.png")) {
                $images[] = array(
                    'url' => URL::to("/img/favicons", "$address.png"),
                    'title' => $server->address . " favicon"
                );
            }

            $sitemap->add($loc, $lastmod, 0.8, $freq, $images);
        }

        $sitemap->add(URL::to('/server/add'), null, '0.5', 'weekly');
    }

    return $sitemap->render();
});

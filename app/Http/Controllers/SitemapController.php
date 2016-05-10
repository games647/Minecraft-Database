<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \App\Server;

class SitemapController extends Controller {

    public function get() {
        /* @var $sitemap Roumen\Sitemap\Sitemap */
        $sitemap = app()->make("sitemap");
        if (!$sitemap->isCached()) {
            $servers = Server::whereOnline(true)->whereNotNull('motd')->orderBy('updated_at', 'desc')->get();

            $sitemap->add(url('/'), collect($servers)->first()->updated_at, '1.0', 'daily');

            //add sites
            $serverCount = $servers->count();
            //5 = per page
            for ($page = 1; $page <= ceil($serverCount / 5); $page++) {
                $sitemap->add(url('/') . '/?page=' . $page, collect($servers)->first()->updated_at, '0.6', 'weekly');
            }

            /* @var $server \App\Server */
            foreach ($servers as $server) {
                $address = $server->address;

                $loc = url("/server", $address);
                $lastmod = $server->updated_at;
                $freq = 'daily';

                $images = array();
                if (file_exists(public_path() . "/img/favicons/$address.png")) {
                    $images[] = array(
                        'url' => url("/img/favicons", "$address.png"),
                        'title' => $server->address . " minecraft server favicon"
                    );
                }

                $sitemap->add($loc, $lastmod, 0.8, $freq, $images);
            }

            $sitemap->add(url('/server/add'), null, '0.5', 'weekly');
            $sitemap->add(url('/search'), null, '0.5', 'weekly');
        }

        return $sitemap->render();
    }
}

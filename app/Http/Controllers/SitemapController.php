<?php

namespace App\Http\Controllers;

use \App\Server;

class SitemapController extends Controller {

    public function getServerPages() {
        /* @var $sitemap Roumen\Sitemap\Sitemap */
        $sitemap = app()->make("sitemap");

        $sitemap->setCache('sitemap.server_pages');
        if (!$sitemap->isCached()) {
            $servers = Server::whereOnline(true)->whereNotNull('motd')->orderBy('updated_at', 'desc')->get();

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
        }

        return $sitemap->render();
    }

    public function getServerIndex() {
        /* @var $sitemap \Roumen\Sitemap\Sitemap */
        $sitemap = app()->make("sitemap");

        $sitemap->setCache('sitemap.server_index');
        if (!$sitemap->isCached()) {
            /* @var $lastUpdatedServer Server */
            $lastUpdatedServer = Server::whereOnline(true)->whereNotNull('motd')->orderBy('updated_at', 'desc')
                    ->firstOrFail();

            $sitemap->add(url('/server'), $lastUpdatedServer->updated_at, '1.0', 'daily');

            //add sites
            $serverCount = Server::whereOnline(true)->whereNotNull('motd')->count();
            //5 = per page
            for ($page = 1; $page <= ceil($serverCount / 5); $page++) {
                $sitemap->add(url('/server') . '/?page=' . $page, $lastUpdatedServer->updated_at, '0.6', 'weekly');
            }

            $sitemap->add(url('/server/add'), null, '0.5', 'weekly');
            $sitemap->add(url('/search'), null, '0.5', 'weekly');
        }

        return $sitemap->render();
    }
}

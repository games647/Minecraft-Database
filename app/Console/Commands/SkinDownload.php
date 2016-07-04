<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\Skin;
use \File;
use \Exception;
use \MinecraftSkins\MinecraftSkins;

class SkinDownload extends Command {

    const SKIN_URL = "http://sessionserver.mojang.com/session/minecraft/profile/<uuid>?unsigned=false";

    protected $signature = 'app:skin {uuid}';
    protected $description = 'Download and save a skin';

    public function handle() {
        $this->info("Downloading skins");

        $uuid = $this->argument("uuid");
        $this->downloadSkin($uuid);
    }

    function downloadSkin($uuid) {
        $url = str_replace("<uuid>", $uuid, self::SKIN_URL);

        $request = curl_init();
        curl_setopt($request, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($request, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($request, CURLOPT_URL, $url);
        try {
            $response = curl_exec($request);

            $curl_info = curl_getinfo($request);
            if ($curl_info['http_code'] !== 200) {
                $this->error("Return code: " . $curl_info['http_code']);
                return;
            }

            $data = json_decode($response, true);
            $skinProperties = $data['properties'][0];

            $skin = new Skin();
            $skin->signature = base64_decode($skinProperties['signature']);

            $skinData = json_decode(base64_decode($skinProperties['value']), true);
            $skin->timestamp = $skinData['timestamp'];
            $skin->profile_id = $skinData['profileId'];
            $skin->profile_name = $skinData['profileName'];

            $textures = $skinData['textures'];
            if (!isset($textures['SKIN'])) {
                $this->error("User has no skin set");
                return;
            }

            $skinTextures = $textures['SKIN'];
            $skin->skin_url = $skinTextures['url'];
            $skin->slim_model = isset($skinTextures['metadata']);
            $this->saveRendered($uuid, $skin->skin_url);

            if (isset($textures['CAPE'])) {
                //user has a cape
                $skin->cape_url = $textures['CAPE']['url'];
            }

            $skin->save();
        } catch (Exception $ex) {
            $this->error($ex);
        } finally {
            curl_close($request);
        }
    }

    function saveRendered($uuid, $url) {
        $rawSkin = imagecreatefromstring(file_get_contents($url));
        $head = MinecraftSkins::head($rawSkin, 8);
        $skin = MinecraftSkins::skin($rawSkin, 8);

        $path = public_path() . "/img/head/$uuid.png";
        //check if it's still the same folder
        if (File::dirname($path) == public_path() . "/img/head") {
            imagepng($head, $path);
        }

        $path = public_path() . "/img/skin/$uuid.png";
        if (File::dirname($path) == public_path() . "/img/skin") {
            imagepng($skin, $path);
        }

        $path = public_path() . "/img/skin/raw/$uuid.png";
        if (File::dirname($path) == public_path() . "/img/skin/raw") {


            $source_imagex = imagesx($rawSkin);
            $source_imagey = imagesy($rawSkin);

            $dest = 200;
            $canvas = imagecreatetruecolor($dest, $dest);

            imagealphablending($canvas, true);
            imagesavealpha($canvas, true);

            $transparent = imagecolorallocatealpha($canvas, 255, 255, 255, 127);
            imagefill($canvas, 0, 0, $transparent);



            imagecopyresampled($canvas, $rawSkin, 0, 0, 0, 0,
                $dest, $dest, $source_imagex, $source_imagey);

            imagepng($canvas, $path);
        }
    }
}

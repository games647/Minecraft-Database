<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Skin
 *
 * @property integer $id
 * @property string $profile_id
 * @property string $profile_name
 * @property string $skin_url
 * @property string $cape_url
 * @property boolean $slim_model
 * @property mixed $signature
 * @property integer $timestamp
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Skin whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Skin whereProfileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Skin whereProfileName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Skin whereSkinUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Skin whereCapeUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Skin whereSlimModel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Skin whereSignature($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Skin whereTimestamp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Skin whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Skin whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Skin extends Model {

    protected $table = 'skins';

    public function getEncodedData() {
        $data = array();
        $data['timestamp'] = $this->timestamp;
        $data['profileId'] = str_replace("-", "", $this->profile_id);
        $data['profileName'] = $this->profile_name;
        $data['signatureRequired'] = true;

        $textures = array();
        $textures['SKIN'] = ["url" => $this->skin_url];

        if ($this->slim_model) {
            $textures['SKIN']["metadata"] = ["model" => "slim"];
        }

        if ($this->cape_url) {
            $textures['CAPE'] = ["url" => $this->cape_url];
        }

        $data['textures'] = $textures;
        return base64_encode(json_encode($data, JSON_UNESCAPED_SLASHES));
    }

    public function isSignatureValid() {
        $keyPath = resource_path("yggdrasil_session_pubkey.key");
        $pub_key = file_get_contents($keyPath);
        return openssl_verify($this->getEncodedData(), $this->signature, $pub_key, "RSA-SHA1");
    }
}

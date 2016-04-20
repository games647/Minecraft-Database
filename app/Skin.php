<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Skin
 *
 * @property integer $id
 * @property integer $timestamp
 * @property string $profileId
 * @property string $profileName
 * @property string $skinUrl
 * @property string $capeUrl
 * @property mixed $signature
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Skin whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Skin whereTimestamp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Skin whereProfileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Skin whereProfileName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Skin whereSkinUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Skin whereCapeUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Skin whereSignature($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Skin whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Skin whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Skin extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'skins';

    public function getEncodedData() {
        $data = array();
        $data['timestamp'] = $this->timestamp;
        $data['profileId'] = str_replace("-", "", $this->profileId);
        $data['profileName'] = $this->profileName;
        $data['signatureRequired'] = true;

        $textures = array();
        $textures['SKIN'] = ["url" => $this->skinUrl];

        if ($this->capeUrl) {
            $textures['CAPE'] = ["url" => $this->capeUrl];
        }

        $data['textures'] = $textures;
        return base64_encode(json_encode($data, JSON_UNESCAPED_SLASHES));
    }

    public function isSignatureValid() {
        $keyPath = resource_path("yggdrasil_session_pubkey.key");
        $pub_key = file_get_contents($keyPath);

        echo $this->getEncodedData();

        return openssl_verify($this->getEncodedData(), $this->signature, $pub_key, "RSA-SHA1");
    }
}

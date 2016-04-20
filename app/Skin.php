<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Skin
 *
 * @property integer $id
 * @property string $timestamp
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

}

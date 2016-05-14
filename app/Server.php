<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Server
 *
 * @property integer $id
 * @property string $address
 * @property string $motd
 * @property string $version
 * @property boolean $online
 * @property boolean $onlinemode
 * @property integer $players
 * @property integer $maxplayers
 * @property integer $ping
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Server whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Server whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Server whereMotd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Server whereVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Server whereOnline($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Server whereOnlinemode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Server wherePlayers($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Server whereMaxplayers($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Server wherePing($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Server whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Server whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Server whereDeletedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PluginUsage[] $plugins
 */
class Server extends Model {

    const DEFAULT_PORT = 25565;
    const DEFAULT_BUNGEE_QUERY_PORT = 25577;

    use SoftDeletes;

    protected $table = 'servers';

    public function plugins() {
        return $this->hasMany('App\PluginUsage');
    }

    public function getHtmlMotd() {
        return \MinecraftColors::convertToHTML($this->motd, true);
    }

    public function getPlainMotd() {
        return \MinecraftColors::clean($this->motd);
    }
}

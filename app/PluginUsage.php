<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PluginUsage
 *
 * @property integer $id
 * @property integer $server_id
 * @property string $plugin
 * @property string $version
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\PluginUsage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PluginUsage whereServerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PluginUsage wherePlugin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PluginUsage whereVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PluginUsage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PluginUsage whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Server $server
 */
class PluginUsage extends Model {

    protected $table = 'plugin_usages';

    public function server() {
        return $this->belongsTo('App\Server');
    }
}

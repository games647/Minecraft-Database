<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Player
 *
 * @property integer $id
 * @property string $uuid
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Player whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Player whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Player whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Player whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Player whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\NameHistory[] $nameHistory
 */
class Player extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'players';

    public function generateOfflineUUID() {
        return Console\Commands\Ping::constructOfflinePlayerUuid($this->name);
    }

    public function nameHistory() {
        return $this->hasMany('App\NameHistory');
    }
}

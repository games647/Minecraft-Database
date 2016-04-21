<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\NameHistory
 *
 * @property integer $id
 * @property integer $player_id
 * @property string $name
 * @property integer $changedToAt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Player $owner
 * @method static \Illuminate\Database\Query\Builder|\App\NameHistory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NameHistory wherePlayerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NameHistory whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NameHistory whereChangedToAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NameHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NameHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NameHistory extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'name_histories';

    public function player() {
        return $this->belongsTo('App\Player');
    }
}

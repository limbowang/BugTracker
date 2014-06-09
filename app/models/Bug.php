<?php
/**
 * Created by PhpStorm.
 * 
 * User: Limbo
 * Date: 14-5-25
 * Time: 下午10:28
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $details
 * @property string $os
 * @property string $software
 * @property string $level
 * @property string $tag
 * @property string $img
 * @property integer $read_count
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \user $user
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\comment[] $comments
 */

class Bug extends Eloquent {

    protected $table = 'bug';

    protected $softDelete = true;

    public function user() {
        return $this->belongsTo('\User');
    }

    public function comments() {
        return $this->hasMany('\Comment');
    }

}
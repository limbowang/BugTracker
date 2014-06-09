<?php
/**
 * Created by PhpStorm.
 * 
 * User: Limbo
 * Date: 14-5-25
 * Time: 下午10:31
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\post[] $posts
 */

class Topic extends Eloquent {

    protected $table = 'bbs_topic';

    public function posts() {
        return $this->hasMany('\Post');
    }
} 
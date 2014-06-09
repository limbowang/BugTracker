<?php
/**
 * Created by PhpStorm.
 * 
 * User: Limbo
 * Date: 14-5-25
 * Time: 下午10:29
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $post_id
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \user $user
 * @property-read \post $post
 */

class Reply extends Eloquent {

    protected $table = 'bbs_reply';

    protected $softDelete = true;

    public function user() {
        return $this->belongsTo('\User');
    }

    public function post() {
        return $this->belongsTo('\Post');
    }

}
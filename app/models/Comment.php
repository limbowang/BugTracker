<?php
/**
 * Created by PhpStorm.
 * 
 * User: Limbo
 * Date: 14-5-25
 * Time: 下午10:30
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $bug_id
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */

class Comment extends Eloquent{

    protected $table = 'bug_comment';

    public function user() {
        return $this->belongsTo('user');
    }

    public function bug() {
        return $this->belongsTo('bug');
    }
} 
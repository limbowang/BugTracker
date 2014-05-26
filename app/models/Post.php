<?php
/**
 * Created by PhpStorm.
 * 
 * User: Limbo
 * Date: 14-5-25
 * Time: 下午10:25
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $content
 * @property integer $read_count
 * @property boolean $is_top
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property integer $topic_id
 */

class Post  extends Eloquent {

    protected $table = 'bbs_post';

} 
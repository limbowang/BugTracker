<?php
/**
 * Created by PhpStorm.
 * User: Limbo
 * Date: 14-6-8
 * Time: 下午10:04
 */

class Activity extends Eloquent {

    protected $table = 'activity';

    public function users() {
        return $this->hasMany('user');
    }
} 
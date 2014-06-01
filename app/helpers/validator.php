<?php
/**
 * Created by PhpStorm.
 * User: Limbo
 * Date: 14-6-1
 * Time: 下午10:30
 */

Validator::extend('passcheck', function($attribute, $value, $parameters) {
    return Hash::check($value, Auth::user()->password); // Works for any form!
});
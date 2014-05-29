<?php
/**
 * Created by PhpStorm.
 * User: Limbo
 * Date: 14-5-29
 * Time: 下午1:52
 */

function time2Units($time) {
    $time = strtotime($time);
    $time = time() - $time;

    $year = floor($time / 60 / 60 / 24 / 365);
    $time -= $year * 60 * 60 * 24 * 365;
    $month = floor($time / 60 / 60 / 24 / 30);
    $time -= $month * 60 * 60 * 24 * 30;
    $week = floor($time / 60 / 60 / 24 / 7);
    $time -= $week * 60 * 60 * 24 * 7;
    $day = floor($time / 60 / 60 / 24);
    $time -= $day * 60 * 60 * 24;
    $hour = floor($time / 60 / 60);
    $time -= $hour * 60 * 60;
    $minute = floor($time / 60);
    $time -= $minute * 60;
    $elapse = '';

    $unitArr = array('年前' => 'year', '个月前' => 'month', '周前' => 'week', '天前' => 'day',
        '小时前' => 'hour', '分钟前' => 'minute');

    foreach ($unitArr as $cn => $u) {
        if ($$u > 0) {
            $elapse = $$u . $cn;
            break;
        }
    }

    return $elapse;
}
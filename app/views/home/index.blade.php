@extends('layout.masternomsg')

@section('content')
<div class="intro">
    <div class="container">
        <h2>欢迎来到Bug Tracker</h2>

        <p>一起发现，一起分享，一起讨论</p>

        <p>Bug Tracker伴你左右</p>

        <div>
            {{ HTML::link('/bug', '了解更多', array('class' => 'btn btn-success btn-lg')) }}
            {{ HTML::link('/signin', '加入我们', array('class' => 'btn btn-warning btn-lg')) }}
        </div>
    </div>
</div>
<div class="container">
</div>
<div class="container tiles">
    <div class="col-xs-4">
        <div class="tile">
            {{ HTML::image('images/icons/svg/clipboard.svg', 'Compas', array('class'=> 'tile-image big-illustration')) }}

            <h3 class="tile-title">关于漏洞</h3>

            <p>查看所有用户发布的漏洞</p>
            {{ HTML::link('/bug', '查看更多', array('class' => 'btn btn-primary btn-large btn-block')) }}
        </div>
    </div>

    <div class="col-xs-4">
        <div class="tile">
            {{ HTML::image('images/icons/svg/loop.svg', 'Infinity-Loop', array('class'=> 'tile-image big-illustration')) }}

            <h3 class="tile-title">关于排名</h3>

            <p>查看当前热门的漏洞、活跃的用户</p>
            {{ HTML::link('/ranks', '查看更多', array('class' => 'btn btn-primary btn-large btn-block')) }}
        </div>
    </div>

    <div class="col-xs-4">
        <div class="tile">
            {{ HTML::image('images/icons/svg/pencils.svg', 'Pensils', array('class'=> 'tile-image big-illustration')) }}
            <h3 class="tile-title">关于讨论</h3>

            <p>与我们分享你关于漏洞的经历</p>
            {{ HTML::link('/bbs', '查看更多', array('class' => 'btn btn-primary btn-large btn-block')) }}
        </div>
    </div>
</div>
@stop
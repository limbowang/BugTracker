@extends('layout.master')

@section('content')
<div class="intro">
    <div class="container">
        <h2>Welcome to Bug Tracker</h2>

        <p>In Bug Tracker, write down your software use experience, record bugs and discuss.</p>

        <p>Bug Tracker always companies with you!</p>

        <div>
            <a class="btn btn-primary btn-lg" role="button">Learn more</a>
            <a class="btn btn-warning btn-lg" role="button">Join us</a>
        </div>
    </div>
</div>
<div class="container">
    <div class="span12 text-center">
        <h4>What We Do</h4>
    </div>
    <hr/>
</div>
<div class="container tiles">
    <div class="col-xs-4">
        <div class="tile">
            {{ HTML::image('images/icons/svg/clipboard.svg', 'Compas', array('class'=> 'tile-image big-illustration'))
            }}

            <h3 class="tile-title">Bug List</h3>

            <p>See bugs from all users</p>
            <a class="btn btn-primary btn-large btn-block" href="http://designmodo.com/flat">Show more</a>
        </div>
    </div>

    <div class="col-xs-4">
        <div class="tile">
            {{ HTML::image('images/icons/svg/loop.svg', 'Infinity-Loop', array('class'=> 'tile-image big-illustration'))
            }}

            <h3 class="tile-title">Software Ranks</h3>

            <p>See which software is most popular now!</p>
            <a class="btn btn-primary btn-large btn-block" href="http://designmodo.com/flat">Show more</a>
        </div>
    </div>

    <div class="col-xs-4">
        <div class="tile">
            {{ HTML::image('images/icons/svg/pencils.svg', 'Pensils', array('class'=> 'tile-image big-illustration')) }}
            <h3 class="tile-title">Discussions</h3>

            <p>Share your use experience of software with us</p>
            <a class="btn btn-primary btn-large btn-block" href="http://designmodo.com/flat">Show more</a>
        </div>
    </div>
</div>
@stop
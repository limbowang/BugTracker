@extends('layout.master')

@section('content')

{{ Form::open(array('url' => '/user', 'class' => 'form-container form-horizontal signup-form')) }}

<div class="form-group">
    {{ Form::label('input-username', '用户名', array('class' => 'col-sm-3 control-label required')) }}
    <div class="col-sm-9">
        {{ Form::text('username', Input::old('username'), array('id' => 'input-username', 'class' => 'form-control')) }}
        <div class='form-error-msg'>{{ $errors->get('username')[0] or '' }}</div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('input-email', '邮箱', array('class' => 'col-sm-3 control-label required')) }}
    <div class="col-sm-9">
        {{ Form::email('email', Input::old('email'), array('id' => 'input-email', 'class' => 'form-control')) }}
        <div class='form-error-msg'>{{ $errors->get('email')[0] or '' }}</div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('input-password', '密码', array('class' => 'col-sm-3 control-label required')) }}
    <div class="col-sm-9">
        {{ Form::password('password', array('id' => 'input-password', 'class' => 'form-control')) }}
        <div class='form-error-msg'>{{ $errors->get('password')[0] or '' }}</div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('input-pwconfirm', '确认密码', array('class' => 'col-sm-3 control-label required')) }}
    <div class="col-sm-9">
        {{ Form::password('password_confirmation', array('id' => 'input-pwconfirm', 'class' => 'form-control')) }}
        <div class='form-error-msg'>{{ $errors->get('password_confirmation')[0] or '' }}</div>
    </div>
</div>

{{ Form::submit('注册', array('class' => 'btn btn-warning btn-lg btn-block')) }}
{{ HTML::link('signin', '已经有账号？', array('class' => 'form-link')) }}

{{ Form::close() }}

@stop
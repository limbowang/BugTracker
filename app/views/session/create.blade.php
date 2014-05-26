@extends('layout.master')

@section('content')

@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

{{ Form::open(array('url' => '/session', 'class' => 'form-container signin-form')) }}

<div class="form-group">
    {{ Form::text('username', null, array('id' => 'login-name', 'class' => 'form-control form-field', 'placeholder' => '用户名')) }}
    {{ Form::label('login-name', ' ', array('class' => 'form-field-icon fui-user')) }}
    <div class='form-error-msg'>{{ $errors->get('username')[0] or '' }}</div>
</div>

<div class="form-group">
    {{ Form::password('password', array('id' => 'login-pass', 'class' => 'form-control form-field', 'placeholder' => '密码')) }}
    {{ Form::label('login-pass', ' ', array('class' => 'form-field-icon fui-user')) }}
    <div class='form-error-msg'>{{ $errors->get('password')[0] or '' }}</div>
</div>

<div class="form-group">
    <label class="checkbox" for="checkbox2">
        <span class="icons">
        <span class="first-icon fui-checkbox-unchecked"></span>
        <span class="second-icon fui-checkbox-checked"></span>
        </span>
        <input type="checkbox" id="checkbox2" data-toggle="checkbox" name='rememberme'>
            记住我
    </label>
</div>

{{ Form::submit('登陆', array('class' => 'btn btn-primary btn-lg btn-block')) }}
{{ HTML::link('signup', '忘记密码', array('class' => 'form-link')) }}

{{ Form::close() }}

@stop
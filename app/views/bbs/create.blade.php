@extends('layout.master')

@section('content')
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

{{ Form::open(array('url' => '/bbs', 'class' => 'form-container signin-form')) }}

<div class="form-group">
    {{ Form::label('post-topic', '话题：', array('class' => 'control-label required')) }}
    {{ Form::select('topic', $topics, array('id' => 'post-topic', 'class' => 'select-block')) }}
    <div class='form-error-msg'>{{ $errors->get('topic')[0] or '' }}</div>
</div>

<div class="form-group">
    {{ Form::label('post-title', '标题：', array('class' => 'control-label required')) }}
    {{ Form::text('title', Input::old('title'), array('id' => 'post-title', 'class' => 'form-control form-field', 'placeholder' => '请输入2~50个字符')) }}
    <div class='form-error-msg'>{{ $errors->get('title')[0] or '' }}</div>
</div>

<div class="form-group">
    {{ Form::label('post-content', '内容：', array('class' => 'control-label required')) }}
    {{ Form::textarea('content', Input::old('content'), array('id' => 'post-content', 'class' => 'form-control form-field', 'placeholder' => '请输入2~255个字符')) }}
    <div class='form-error-msg'>{{ $errors->get('content')[0] or '' }}</div>
</div>

{{ Form::submit('提交', array('class' => 'btn btn-primary btn-lg btn-block')) }}

{{ Form::close() }}
@stop
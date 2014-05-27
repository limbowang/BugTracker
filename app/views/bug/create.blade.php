@extends('layout.master')

@section('content')
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

{{ Form::open(array('url' => '/bug', 'class' => 'form-container signin-form')) }}

<div class="form-group">
    {{ Form::label('bug-name', '漏洞名称：', array('class' => 'control-label required')) }}
    {{ Form::text('name', null, array('id' => 'bug-name', 'class' => 'form-control form-field', 'placeholder' => '用户名')) }}
    <div class='form-error-msg'>{{ $errors->get('name')[0] or '' }}</div>
</div>

<div class="form-group">
    {{ Form::label('bug-details', '具体描述：', array('class' => 'control-label required')) }}
    {{ Form::textarea('details', null, array('id' => 'bug-details', 'class' => 'form-control form-field', 'placeholder' => '用户名')) }}
    <div class='form-error-msg'>{{ $errors->get('details')[0] or '' }}</div>
</div>

<div class="form-group">
    {{ Form::label('bug-os', '操作系统：', array('class' => 'control-label required')) }}
    {{ Form::text('os', null, array('id' => 'bug-os', 'class' => 'form-control form-field', 'placeholder' => '用户名')) }}
    <div class='form-error-msg'>{{ $errors->get('os')[0] or '' }}</div>
</div>

<div class="form-group">
    {{ Form::label('bug-software', '漏洞软件：', array('class' => 'control-label required')) }}
    {{ Form::text('software', null, array('id' => 'bug-software', 'class' => 'form-control form-field', 'placeholder' => '用户名')) }}
    <div class='form-error-msg'>{{ $errors->get('software')[0] or '' }}</div>
</div>

<div class="form-group">
    {{ Form::label('bug-level', '级别：', array('class' => 'control-label required')) }}
    {{ Form::select('level', array('high' => '高', 'middle' => '中', 'low' => '低'), array('class' => 'select-block')) }}
    <div class='form-error-msg'>{{ $errors->get('software')[0] or '' }}</div>
</div>

<div class="form-group">
    {{ Form::label('bug-tag', '标签：', array('class' => 'control-label')) }}
    {{ Form::text('tags', null, array('id' => 'bug-tag', 'class' => 'tagsinput', 'placeholder' => '用户名')) }}
    <div class='form-error-msg'>{{ $errors->get('tags')[0] or '' }}</div>
</div>

<div class="form-group">
    {{ Form::label('bug-img', '图片：', array('class' => 'control-label')) }}
    {{ Form::file('img', array('id' => 'bug-img', 'class' => '')) }}
    <div class='form-error-msg'>{{ $errors->get('img')[0] or '' }}</div>
</div>

{{ Form::submit('提交', array('class' => 'btn btn-primary btn-lg btn-block')) }}

{{ Form::close() }}
@stop
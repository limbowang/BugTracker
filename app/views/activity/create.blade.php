@extends('layout.master')

@section('content')

{{ Form::open(array('url' => '/activity', 'class' => 'form-container signin-form')) }}

<div class="form-group">
    {{ Form::label('activity-title', '活动名字：', array('class' => 'control-label required')) }}
    {{ Form::text('title', Input::old('title'), array('id' => 'activity-title', 'class' => 'form-control form-field', 'placeholder' => '请输入2~50个字符')) }}
    <div class='form-error-msg'>{{ $errors->get('title')[0] or '' }}</div>
</div>

<div class="form-group">
    {{ Form::label('post-content', '活动描述：', array('class' => 'control-label required')) }}
    {{ Form::textarea('description', Input::old('description'), array('id' => 'post-content', 'class' => 'form-control form-field', 'placeholder' => '请输入10~255个字符')) }}
    <div class='form-error-msg'>{{ $errors->get('description')[0] or '' }}</div>
</div>

{{ Form::submit('提交', array('class' => 'btn btn-primary btn-lg btn-block')) }}

{{ Form::close() }}
@stop
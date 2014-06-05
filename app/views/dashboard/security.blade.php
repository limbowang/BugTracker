@extends('dashboard.layout')

@section('dashboard')

<div class="dashboard">
    <div class="dashboard-header">个人资料</div>
    <div class="dashboard-content">
        {{ Form::model($user, array('method'=>'PUT', 'files' => true, 'url' => '/user/' . Auth::id(), 'class' =>
        'form-horizontal', 'role' => 'form')) }}
        <h6>提示问题</h6>
        @if (!empty($user->question))
        <div class="form-group">
            <label class="col-sm-4 control-label">提示问题</label>

            <div class="col-sm-5">
                <p class="form-control-static">{{ $user->question }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">回答</label>

            <div class="col-sm-5">
                {{ Form::text('answer', '', array('id' => 'input-email', 'class' => 'form-control form-field')) }}
                <div class='form-error-msg'>{{ $errors->get('answer')[0] or '' }}</div>
            </div>
        </div>
        @endif
        <div class="form-group">
            <label class="col-sm-4 control-label">新的提示问题</label>

            <div class="col-sm-5">
                {{ Form::text('new_question', Input::old('new_question'), array('id' => 'input-new-question',
                'class' => 'form-control
                form-field',
                'placeholder' => '请输入2~20个字符')) }}
                <div class='form-error-msg'>{{ $errors->get('new_question')[0] or '' }}</div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">新的回答</label>

            <div class="col-sm-5">
                {{ Form::text('new_answer', Input::old('new_answer'), array('id' => 'input-new-answer', 'class' =>
                'form-control
                form-field',
                'placeholder' => '请输入2~20个字符')) }}
                <div class='form-error-msg'>{{ $errors->get('new_answer')[0] or '' }}</div>
            </div>
        </div>
        <hr/>
        <h6>密码修改</h6>

        <div class="form-group">
            <label class="col-sm-4 control-label">旧密码</label>

            <div class="col-sm-5">
                {{ Form::password('old_password', array('id' => 'input-oldpw', 'class' => 'form-control
                form-field', 'placeholder' => '请输入6~20个字符')) }}
                <div class='form-error-msg'>{{ $errors->get('old_password')[0] or '' }}</div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">新密码</label>

            <div class="col-sm-5">
                {{ Form::password('new_password', array('id' => 'input-newpw', 'class' => 'form-control
                form-field',
                'placeholder' => '请输入6~20个字符')) }}
                <div class='form-error-msg'>{{ $errors->get('new_password')[0] or '' }}</div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">新密码确认</label>

            <div class="col-sm-5">
                {{ Form::password('new_password_confirmation', array('id' => 'input-newpwc', 'class' =>
                'form-control form-field',
                'placeholder' => '请输入6~20个字符')) }}
                <div class='form-error-msg'>{{ $errors->get('new_password_confirmation')[0] or '' }}</div>
            </div>
        </div>
        <hr/>
        <input type="text" name="type" value="s" hidden="hidden"/>

        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-4">
                <input type="submit" class="btn btn-warning btn-lg" value="保存">
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
@stop
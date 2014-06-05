@extends('dashboard.layout')

@section('dashboard')

<div class="dashboard">
    <div class="dashboard-header">个人资料</div>
    <div class="dashboard-content">
        {{ Form::model($user, array('method'=>'PUT', 'files' => true, 'route' => array('user.update', Auth::id()),
        'class' =>
        'form-horizontal', 'role' => 'form')) }}
        <div class="form-group">
            <label class="col-sm-4 control-label required">邮箱</label>

            <div class="col-sm-5">
                {{ Form::text('email', null, array('id' => 'input-email', 'class' => 'form-control')) }}
                <div class='form-error-msg'>{{ $errors->get('email')[0] or '' }}</div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label required">头像</label>

            <div class="well col-sm-5">
                {{ HTML::image(Auth::user()->avatar ? Auth::user()->avatar : '/images/default.jpg', '', array('class'=>
                'pull-left')) }}
                <div class="form-upload">
                    <input type="button" class="btn btn-info btn-upload" value="更改"/>

                    <div>
                        选择的图片：<span class="filename">无</span>
                    </div>
                    <div class='form-error-msg'>{{ $errors->get('avatar')[0] or '' }}</div>
                    <input type="file" name="avatar" class="form-control input-img-upload" id="input-avatar">
                </div>
            </div>
        </div>
        <hr/>
        <input type="text" name="type" value="p" hidden="hidden"/>

        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-4">
                <input type="submit" class="btn btn-warning btn-lg" value="保存">
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>

@stop
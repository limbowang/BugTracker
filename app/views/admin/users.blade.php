@extends('admin.layout')

@section('admin')

<div class="dashboard">
    <div class="dashboard-header">所有用户</div>
    <div class="dashboard-content">
        @if (count($users) == 0)
        <span class="no-list">暂无用户</span>
        @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th>编号</th>
                <th>用户名</th>
                <th>邮箱</th>
                <th>注册时间</th>
                <th>管理员</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ HTML::link('/user/' . $user->id, $user->username) }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->isAdmin() ? '是' : '否' }}</td>
                <td>
<!--                    <span>提升为管理员</span>-->
                    @if (!$user->isAdmin())
                    <span>
                        <a href="javascript:void(0);" class="btn-delete" data-toggle="modal" data-target="#modal-delete"
                           data-item-id="user-{{ $user->id }}" data-item-title="{{ $user->username }}">删除</a>
                    </span>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
        @endif
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <span class="modal-title" id="modalLabel">确认删除用户</span>
            </div>
            <div class="modal-footer">
                {{ Form::open(array('method'=>'DELETE', 'url'=>'', 'id' => 'form-delete')) }}
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="submit" class="btn btn-primary">删除</button>
                {{ Form::close() }}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop
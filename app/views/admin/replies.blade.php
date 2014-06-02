@extends('admin.layout')

@section('admin')

<div class="dashboard">
    <div class="dashboard-header">所有评论</div>
    <div class="dashboard-content">
        @if ($replies->count() == 0)
        <span class="no-list">暂无评论</span>
        @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th>编号</th>
                <th>内容</th>
                <th>相关帖子</th>
                <th>发布人</th>
                <th>发布时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($replies as $reply)
            <tr>
                <td>{{ $reply->id }}</td>
                <td>{{ $reply->content }}</td>
                <td>{{ HTML::link('/reply/' . $reply->post->id, $reply->post->content) }}</td>
                <td>{{ $reply->user->username }}</td>
                <td>{{ $reply->created_at }}</td>
                <td>
                    @if ($reply->trashed())
                    <span>
                        恢复
                    </span>
                    @else
                    <span>
                        <a href="javascript:void(0);" class="btn-delete" data-toggle="modal" data-target="#modal-delete"
                           data-item-id="reply-{{ $reply->id }}" data-item-title="{{ $reply->content }}">删除</a>
                    </span>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ $replies->links() }}
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
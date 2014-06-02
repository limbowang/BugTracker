@extends('admin.layout')

@section('admin')

<div class="dashboard">
    <div class="dashboard-header">所有评论</div>
    <div class="dashboard-content">
        @if ($comments->count() == 0)
        <span class="no-list">暂无评论</span>
        @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th>编号</th>
                <th>内容</th>
                <th>相关漏洞</th>
                <th>发布人</th>
                <th>发布时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
            <tr>
                <td>{{ $comment->id }}</td>
                <td>{{ $comment->content }}</td>
                <td>{{ HTML::link('/bug/' . $comment->bug->id, $comment->bug->name) }}</td>
                <td>{{ $comment->user->username }}</td>
                <td>{{ $comment->created_at }}</td>
                <td>
                    @if ($comment->trashed())
                    <span>
                        恢复
                    </span>
                    @else
                    <span>
                        <a href="javascript:void(0);" class="btn-delete" data-toggle="modal" data-target="#modal-delete"
                           data-item-id="content-{{ $comment->id }}" data-item-title="{{ $comment->content }}">删除</a>
                    </span>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ $comments->links() }}
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
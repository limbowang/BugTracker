@extends('admin.layout')

@section('admin')

<div class="dashboard">
    <div class="dashboard-header">所有帖子</div>
    <div class="dashboard-content">
        @if ($posts->count() == 0)
        <span class="no-list">暂无帖子</span>
        @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th>编号</th>
                <th>标题</th>
                <th>发布人</th>
                <th>发布时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ HTML::link('/post/' . $post->id, $post->title) }}</td>
                <td>{{ $post->user->username }}</td>
                <td>{{ $post->created_at }}</td>
                <td>
                    @if ($post->trashed())
                    <span>
                        恢复
                    </span>
                    @else
                    <span>
                        <a href="javascript:void(0);" class="btn-delete" data-toggle="modal" data-target="#modal-delete"
                           data-item-id="bbs-{{ $post->id }}" data-item-title="{{ $post->title }}">删除</a>
                    </span>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ $posts->links() }}
        @endif
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <span class="modal-title" id="modalLabel">确认删除帖子</span>
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
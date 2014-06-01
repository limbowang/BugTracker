@extends('dashboard.layout')

@section('dashboard')

<div class="dashboard">
    <div class="dashboard-header">我的帖子</div>
    <div class="dashboard-content">
        @if (count($posts) == 0)
        <span class="no-list">您还未发表任何帖子</span>
        @else
        <ul class="lists">
            @foreach($posts as $post)
            <li class="list-item">
                <div class="list-item-content">
                    {{ HTML::link('/post/' . $post->id, $post->title) }}
                    <span class="time">发布于{{ $post->created_at }}</span>
                </div>
                <div class="list-item-footer">
                    {{ HTML::link('/bbs/' . $post->id . '#replies', '回复(' . count($post->replies) . ')') }}
                    {{ HTML::link('/bbs/' . $post->id . '/edit', '更新') }}
                    <a href="javascript:void(0);" class="btn-delete" data-toggle="modal" data-target="#modal-delete"
                       data-item-id="bbs-{{ $post->id }}" data-item-title="{{ $post->title }}">删除</a>
                </div>
            </li>
            @endforeach
        </ul>
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
                <span class="modal-title" id="modalLabel">确认删除漏洞</span>
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
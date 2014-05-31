@extends('dashboard.layout')

@section('dashboard')

<div class="dashboard">
    <div class="dashboard-header">我的评论</div>
    <div class="dashboard-content">
        @if(count($replies) == 0)
            <span class="no-list">暂无回复</span>
        @else
        <ul class="lists">
            @foreach($replies as $reply)
            <li class="list-item">
                <div class="list-item-content">
                    <div class="status">
                        <span>
                            <a href="{{ '/user/' . $reply->user->id }}">{{ $reply->user->username }}</a>
                            于<span class="time">{{ $reply->created_at }}</span>评论了帖子
                            <a href="{{ '/bbs/' . $reply->post->id }}">{{ $reply->post->title }}</a>:
                        </span>
                    </div>
                    <div class="quatation">{{ $reply->content }}</div>
                </div>
                <div class="list-item-footer">
                    <div class="list-item-footer">
                        {{ HTML::link('/bbs/' . $reply->post->id, '查看帖子') }}
                        <a href="javascript:void(0);" class="btn-delete" data-toggle="modal" data-target="#modal-delete"
                           data-item-id="reply-{{ $reply->id }}" data-item-title="{{ $reply->content }}">删除</a>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
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
                <span class="modal-title" id="modalLabel">确认删除回复</span>
            </div>
            <div class="modal-footer">
                {{ Form::open(array('method'=>'DELETE', 'url'=>'', 'id' => 'form-delete')) }}
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="submit" class="btn btn-primary">删除</button>
                {{ Form::close() }}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop
@extends('dashboard.layout')

@section('dashboard')

<div class="dashboard">
    <div class="dashboard-header">收到的评论</div>
    <div class="dashboard-content">
        <ul class="lists">
            @foreach($comments as $comment)
            <li class="list-item">
                <div class="list-item-content">
                    <div class="status">
                        <span>
                            <a href="{{ '/user/' . $comment->user->id }}">{{ $comment->user->username }}</a>
                            于<span class="time">{{ $comment->created_at }}</span>评论了你的漏洞
                            <a href="{{ '/bug/' . $comment->bug->id }}">{{ $comment->bug->name }}</a>:
                        </span>
                    </div>
                    <div class="quatation">{{ $comment->content }}</div>
                </div>
                <div class="list-item-footer">
                    <div class="list-item-footer">
                        {{ HTML::link('/bug/' . $comment->bug->id, '查看帖子') }}
                        <a href="#">删除</a>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>

@stop
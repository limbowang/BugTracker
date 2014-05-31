@extends('dashboard.layout')

@section('dashboard')

<div class="dashboard">
    <div class="dashboard-header">我的评论</div>
    <div class="dashboard-content">
        <ul class="lists">
            @foreach($replies as $reply)
            <li class="list-item">
                <div class="list-item-content">
                    <div class="status">
                        <span>
                            <a href="{{ '/user/' . $reply->user->id }}">{{ $reply->user->username }}</a>
                            于<span class="time">{{ $reply->created_at }}</span>评论了漏洞
                            <a href="{{ '/bbs/' . $reply->post->id }}">{{ $reply->post->title }}</a>:
                        </span>
                    </div>
                    <div class="quatation">{{ $reply->content }}</div>
                </div>
                <div class="list-item-footer">
                    <div class="list-item-footer">
                        {{ HTML::link('/bbs/' . $reply->post->id, '查看帖子') }}
                        <a href="#">删除</a>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>

@stop
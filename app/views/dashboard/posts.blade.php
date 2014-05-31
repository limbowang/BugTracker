@extends('dashboard.layout')

@section('dashboard')

<div class="dashboard">
    <div class="dashboard-header">我的帖子</div>
    <div class="dashboard-content">
        <ul class="lists">
            @foreach($posts as $post)
            <li class="list-item">
                <div class="list-item-content">
                    {{ HTML::link('/post/' . $post->id, $post->title) }}
                    <span class="time">发布于{{ $post->created_at }}</span>
                </div>
                <div class="list-item-footer">
                    {{ HTML::link('/post/' . $post->id . '#replies', '回复(' . count($post->replies) . ')') }}
                    <a href="#">更新</a>
                    <a href="#">删除</a>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>

@stop
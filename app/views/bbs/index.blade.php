@extends('layout.master')

@section('content')
<div class="content">
    <div class="topics">
        <div class="topics-header">
            <div class="sorts">
                <span class="lb">查看：</span>
                <ul>
                    <li class="active">
                        默认
                    </li>
                    <li class="">
                        <a href="#">最新</a>
                    </li>
                    <li class="">
                        <a href="#">最热门</a>
                    </li>
                </ul>
            </div>
        </div>
        <ul class="topics-stream">
            @foreach($posts as $post)
            <li class="topics-stream-item">
                <div class="avatar">
                    <a href="{{ '/user/' . $post->user->id }}">
                        <img src="{{ $post->user->avatar or  '/images/default.jpg'}}" alt=""/>
                    </a>
                </div>
                <div class="title">
                    @if ($post->is_top)
                    <span class="tag label label-info">置顶</span>
                    @endif
                    {{ HTML::link('/bbs/' . $post->id, $post->title) }}
                    @if (($replyCount = count($post->replies)) != 0)
                    <span class="badge pull-right">{{ $replyCount }}</span>
                    @endif
                </div>
                <div class="description">
                    <span class="tag label label-default">{{ HTML::link('#', $post->topic->name) }}</span>
                    <span>由{{ HTML::link('#', $post->user->username) }}于<span>{{ time2Units($post->created_at) }}</span>发布</span>
                </div>
            </li>
            @endforeach
            {{ $posts->links() }}
        </ul>
    </div>
    <div class="sidebar">
        @if (Auth::check())
        <div class="box">
            <a class="btn btn-warning" href="/bbs/create">发表新帖</a>
        </div>
        @endif
        <div class="box">
            <div class="title">话题</div>
            <ul class="content">
                @foreach(Topic::all() as $topic)
                <li>{{ HTML::link('#', $topic->name) }}</li>
                @endforeach
            </ul>
        </div>
        <div class="box">
            <div class="title">统计信息</div>
            <ul class="content">
                <li>总帖数：{{ Post::count() }}</li>
                <li>总回复数：{{ Reply::count() }}</li>
            </ul>
        </div>
    </div>
</div>
<div class="clearfix"></div>

@stop
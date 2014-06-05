@extends('home.search')

@section('search-result')
<div class="search-content">
    @if ($users->count() == 0)
    <div>没有有关“<em>{{ $keyword }}</em>”的结果</div>
    @else
    <ul class="search-list">
        @foreach($users as $user)
        <li class="search-list-item">
            <div class="avatar">
                <a href="{{ '/user/' . $user->id }}">
                    <img src="{{ $user->avatar or '/images/default.jpg' }}" alt=""/>
                </a>
            </div>
            <div class="title">
                <a href="{{ '/user/' . $user->id }}">{{ $user->username }}</a>
            </div>
            <div class="description">
                <ul class="user-info">
                    <li><span>发布漏洞数：</span>{{ $user->bugs->count() }}</li>
                    <li><span>评论数：</span>{{ $user->comments->count() }}</li>
                    <li><span>帖子数：</span>{{ $user->posts->count() }}</li>
                    <li><span>回复数：</span>{{ $user->replies->count() }}</li>
                </ul></div>
        </li>
        @endforeach
    </ul>
    @endif
    {{ $users->appends(array('keyword' => $keyword, 'type' => $type))->links() }}
</div>

<div class="sidebar">
    <div class="box">
        <div class="title">漏洞结果</div>
        <ul class="content">
            @if ($bugs->count() == 0)
            <li>没有相关漏洞</li>
            @else
            @foreach($bugs as $bug)
            <li><a href="{{ '/bug/' . $bug->id }}">{{ $bug->name }}</a></li>
            @endforeach
            @endif
        </ul>
    </div>
    <div class="box">
        <div class="title">帖子结果</div>
        <ul class="content">
            @if ($posts->count() == 0)
            <li>没有相关帖子</li>
            @else
            @foreach($posts as $post)
            <li><a href="{{ '/bbs/' . $post->id }}">{{ $post->title }}</a></li>
            @endforeach
            @endif
        </ul>
    </div>
</div>
<!-- end of siderbar -->

@stop
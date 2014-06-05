@extends('home.search')

@section('search-result')
<div class="search-content">
    @if ($posts->count() == 0)
    <div>没有有关“<em>{{ $keyword }}</em>”的结果</div>
    @else
    <ul class="search-list">
        @foreach($posts as $post)
        <li class="search-list-item">
            <div class="avatar">
                <a href="{{ '/user/' . $post->user->id }}">
                    <img src="{{ $user->avatar or '/images/default.jpg' }}" alt=""/>
                </a>
            </div>
            <div class="title">
                <a href="{{ '/bbs/' . $post->id }}">{{ $post->title }}</a>
            </div>
            <div class="description">
                <span>由<a href="{{ '/user/' . $post->user->id }}">{{ $post->user->username }}</a>于<span>{{ time2Units($post->created_at) }}</span>发布</span>
            </div>
            <div class="item-content">{{ $post->content }}</div>
        </li>
        @endforeach
    </ul>
    @endif
    {{ $posts->appends(array('keyword' => $keyword, 'type' => $type))->links() }}
</div>

<div class="sidebar">
    <div class="box">
        <div class="title">用户结果</div>
        <ul class="content">
            @if ($users->count() == 0)
            <li>没有相关用户</li>
            @else
            @foreach($users as $user)
            <li><a href="{{ '/user/' . $user->id }}">{{ $user->username }}</a></li>
            @endforeach
            @endif
        </ul>
    </div>
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
</div>
<!-- end of siderbar -->

@stop
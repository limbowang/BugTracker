@extends('home.search')

@section('search-result')
<div class="search-content">
    @if ($bugs->count() == 0)
    <div>没有有关“<em>{{ $keyword }}</em>”的结果</div>
    @else
    <ul class="search-list">
        @foreach($bugs as $bug)
        <li class="search-list-item no-avatar">
            <div class="title">
                <a href="{{ '/bug/' . $bug->id }}">{{ $bug->name }}</a>
            </div>
            <div class="description">
                <span>由<a href="{{ '/user/' . $bug->user->id }}">{{ $bug->user->username }}</a>于<span>{{ time2Units($bug->created_at) }}</span>发布</span>
            </div>
            <div class="item-content">{{ $bug->details }}</div>
        </li>
        @endforeach
    </ul>
    @endif
    {{ $bugs->appends(array('keyword' => $keyword, 'type' => $type))->links() }}
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
        <div class="title">论坛结果</div>
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
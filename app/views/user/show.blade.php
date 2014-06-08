@extends('layout.master')

@section('content')

<div class="content">
    <div class="user-header">
        <div class="avatar">
            {{ HTML::image($user->avatar ? $user->avatar : '/images/default.jpg', '') }}
        </div>
        <div class="title">{{ $user->username }}</div>
        <div class="description">
            <span>注册于<span class="time">{{ time2Units($user->created_at) }}</span></span>
            <span>漏洞发布数：{{$user->bugs->count()}} 评论数：{{$user->comments->count()}} 发帖数：{{ $user->posts->count() }} 回复数：{{ $user->replies->count() }}</span>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="user-content">
        <div class="category">
            <ul class="nav nav-tabs">
                @foreach($lists as $key=>$item)
                @if ($key == $category)
                <li class="active">
                    {{ HTML::link( Request::url() . '?c=' . $key, $item) }}
                </li>
                @else
                <li>
                    {{ HTML::link( Request::url() . '?c=' . $key, $item) }}
                </li>
                @endif
                @endforeach
            </ul>
        </div>
        @yield('lists')
    </div>
</div>
</div>

@stop
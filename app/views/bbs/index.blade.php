@extends('layout.master')

@section('content')
<div class="content">
    <div class="topics">
        <div class="topics-header">
            <div class="sorts">
                <span class="lb">查看：</span>
                <ul>
                    @foreach($sortlist as $sortkey=>$sortname)
                    @if ($sort == $sortkey)
                    <li class="active">
                        {{ $sortname }}
                    </li>
                    @else
                    <li class="">
                        @if (empty($sortkey))
                        <a href="{{ URL::full() == URL::current() ? URL::full() . '?sort=' . $sortkey : URL::full() . '&sort=' . $sortkey }}">{{
                            $sortname }}</a>
                        @else
                        <a href="{{ URL::full() == URL::current() ? URL::full() . '?sort=' . $sortkey : URL::full() . '&sort=' . $sortkey }}">{{
                            $sortname }}</a>
                        @endif
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
        @if ($posts->count() == 0)
        <div class="well text-center">论坛暂无帖子</div>
        @else
        <ul class="topics-stream">
            @foreach($posts as $post)
            <li class="topics-stream-item">
                <div class="avatar">
                    <a href="{{ '/user/' . $post->user->id }}">
                        {{ HTML::image($post->user->avatar ? $post->user->avatar : '/images/default.jpg', '') }}
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
            {{ $posts->appends(array('sort' => $sort, 'topic' => $topic))->links() }}
        </ul>
        @endif
    </div>
    <div class="sidebar">
        @if (Auth::check())
        <div class="box">
            {{ HTML::link('/bbs/create', '发表新帖', array('class' => 'btn btn-warning')) }}
        </div>
        @endif
        <div class="box">
            <div class="title">话题</div>
            <ul class="content">
                @if (Topic::count() == 0)
                <li>暂无话题</li>
                @else
                @foreach(Topic::all() as $topic)
                <li>{{ HTML::link('bbs?topic=' . $topic->name, $topic->name) }}</li>
                @endforeach
                @endif
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
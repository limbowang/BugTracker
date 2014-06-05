@extends('layout.master')

@section('content')

<div class="content">
    <div class="topic">
        @if (empty($post))
            <div class="alert alert-warning">
                该帖子不存在或已被删除
            </div>
        @else
            <div class="topic-header">
                <div class="avatar">
                    <a href="{{ '/user/' . $post->user->id }}">
                        {{ HTML::image($post->user->avatar ? $post->user->avatar : '/images/default.jpg', '') }}
                    </a>
                </div>
                <div class="title">
                    {{ $post->title }}
                </div>
                <div class="description">
                    <span class="">{{ HTML::link('#', $post->topic->name) }}  </span>
                    <span>由 {{ HTML::link('user/' . $post->user->id, $post->user->username) }} 于<span>{{ time2Units($post->created_at) }}</span>发布</span>
                    <span class=""> 被浏览{{ $post->read_count }}次  </span>
                </div>
            </div>
            <div class="topic-content">
                {{$post->content}}
            </div>

            @if (($count = count($replies)) == 0)
            <div id="replies" class="no-replies">
                没有回复
            </div>
            @else
            <div id="replies" class="replies">
                <div class="reply-header">
                    共{{ $count }}条回复
                </div>
                <ul class="reply-list">
                    @foreach($replies as $reply)
                    @if ($reply->trashed())
                    <li class="reply-list-item">
                        <div class="content">
                            {{ ++$reply_start . '楼 已被删除' }}
                        </div>
                    </li>
                    @else
                    <li class="reply-list-item">
                        <div class="avatar">
                            <a href="{{ '/user/' . $reply->user->id }}">
                                {{ HTML::image($reply->user->avatar ? $reply->user->avatar : '/images/default.jpg', '') }}
                            </a>
                        </div>
                        <div class="title">
                            <span class="name">{{ HTML::link('/user/' . $reply->user->id, $reply->user->username) }}</span>
                            <span class="floor">{{ ++$reply_start . '楼' }}</span>
                            <span class="time">{{ time2Units($reply->created_at) }}</span>
                        </div>
                        <div class="content">
                            {{ $reply->content }}
                        </div>
                    </li>
                    @endif
                    @endforeach
                </ul>
                {{ $replies->links() }}
                <div class="clearfix"></div>
            </div>
            <!-- end of replies -->
            @endif

            {{ Form::open(array('url' => URL::current() . '/reply', 'class' => 'form-container')) }}

            <div class="form-group">
                {{ Form::textarea('content', Input::old('content'), array('id' => 'reply-content', 'class' => 'form-control
                form-field', 'placeholder' => '请输入2~255个字符', 'rows' => 5)) }}
                <div class='form-error-msg'>{{ $errors->get('content')[0] or '' }}</div>
            </div>

            {{ Form::submit('提交', array('class' => 'btn btn-info btn-lg btn-block')) }}

            {{ Form::close() }}
        @endif
    </div>

    <div class="sidebar">
        <div class="box">
            <div class="title">相关讨论</div>
            <ul class="content">
                @if ($related_posts->count() == 0)
                <li>暂无相关讨论</li>
                @else
                @foreach($related_posts as $post)
                <li>{{ HTML::link('/bbs/' . $post->id, $post->title) }}</li>
                @endforeach
                @endif
            </ul>
        </div>
        <div class="box">
            <div class="title">话题</div>
            <ul class="content">
                @foreach($all_topics as $topic)
                <li>{{ HTML::link('/bbs?topic=' . $topic->name, $topic->name) }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- end of siderbar -->
    <div class="clearfix"></div>
</div>
@stop
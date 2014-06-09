@extends('layout.master')

@section('content')
<div class="content">

    <div class="bug-panel">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">漏洞概要</h3>
            </div>
            <div class="panel-body">
                <div>
                    <span>漏洞标题：</span>
                    <span>{{ $bug->name }}</span>
                </div>
                <div>
                    <span>漏洞系统：</span>
                    <span>{{ $bug->os }}</span>
                </div>
                <div>
                    <span>漏洞软件：</span>
                    <span>{{ $bug->software }}</span>
                </div>
                <div>
                    <span>漏洞级别：</span>
                    <span>{{ $bug->level }}</span>
                </div>
                <div>
                    <span>漏洞作者：</span>
                    <span>{{ HTML::link('/user/' . $bug->user->id, $bug->user->username) }}</span>
                </div>
                <div>
                    <span>发布时间：</span>
                    <span>{{ $bug->created_at }}</span>
                </div>
                <div>
                    <span>标签：</span>
                    <span>{{ $bug->tag or '无' }}</span>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">漏洞详情</h3>
            </div>
            <div class="panel-body">
                {{ $bug->details }}
            </div>
        </div>

        @if ($bug->img != null)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">漏洞贴图</h3>
            </div>
            <div class="panel-body">
                <div>
                    {{ HTML::image($bug->img, $bug->title) }}
                </div>
            </div>
        </div>
        @endif

        @if (($count = count($comments)) == 0)
        <div id='comments' class="no-comments">
            暂无评论
        </div>
        @else
        <div id="comments" class="comments">
            <div class="comment-header">
                共{{ $count }}条评论
            </div>
            <ul class="comment-list">
                @foreach($comments as $comment)
                @if ($comment->trashed())
                <li class="comment-list-item">
                    <div class="content">
                        {{ ++$comment_start . '楼 已被删除' }}
                    </div>
                </li>
                @else
                <li class="comment-list-item">
                    <div class="avatar">
                        <a href="{{ 'user/' . $comment->user->id }}">
                            {{ HTML::image($comment->user->avatar ? $comment->user->avatar : '/images/default.jpg', '') }}
                        </a>
                    </div>
                    <div class="title">
                                <span
                                    class="name">{{ HTML::link('/user/' . $comment->user->id, $comment->user->username) }}</span>
                        <span class="floor">{{ ++$comment_start . '楼' }}</span>
                        <span class="time">{{ time2Units($comment->created_at) }}</span>
                    </div>
                    <div class="content">
                        {{ $comment->content }}
                    </div>
                </li>
                @endif
                @endforeach
            </ul>
            {{ $comments->links() }}
            <div class="clearfix"></div>
        </div>
        <!-- end of comments -->
        @endif

        {{ Form::open(array('url' => URL::current() . '/comment', 'class' => 'form-container')) }}

        <div class="form-group">
            {{ Form::label('comment-content', '评论：', array('class' => 'control-label')) }}
            {{ Form::textarea('content', Input::old('content'), array('id' => 'comment-content', 'class' =>
            'form-control
            form-field', 'placeholder' => '请输入2~255个字符', 'rows' => 5)) }}
            <div class='form-error-msg'>{{ $errors->get('content')[0] or '' }}</div>
        </div>

        {{ Form::submit('提交', array('class' => 'btn btn-info btn-lg btn-block')) }}

        {{ Form::close() }}
    </div>

    <div class="sidebar">
        <div class="box">
            <div class="title">最新漏洞</div>
            <ul class="content">
                @if ($latest_bugs->count() == 0)
                <li>暂无漏洞</li>
                @else
                @foreach($latest_bugs as $bug)
                <li>{{ HTML::link('/bug/' . $bug->id, $bug->name) }}</li>
                @endforeach
                @endif
            </ul>
        </div>
        <div class="box">
            <div class="title">热门</div>
            <ul class="content">
                @if ($hottest_bugs->count() == 0)
                <li>暂无漏洞</li>
                @else
                @foreach($hottest_bugs as $bug)
                <li>{{ HTML::link('/bug/' . $bug->id, $bug->name) }}</li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>
    <!-- end of siderbar -->
    <div class="clearfix"></div>
</div>


@stop
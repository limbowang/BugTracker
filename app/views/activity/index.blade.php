@extends('layout.master')

@section('content')
<div class="content">
    <div class="activities">
        <div class="activities-header">
            <div>活动列表</div>
        </div>
        @if ($activities->count() == 0)
        <div class="well text-center">暂无活动</div>
        @else
        <ul class="activities-stream">
            @foreach($activities as $activity)
            <li class="activities-stream-item">
                <div class="avatar">
                    <a href="{{ URL::to('/user/' . $activity->user->id) }}">
                        {{ HTML::image($activity->user->avatar ? $activity->user->avatar : '/images/default.jpg', '') }}
                    </a>
                </div>
                <div class="title">
                    {{ HTML::link('/activity/' . $activity->id, $activity->title) }}
                </div>
                <div class="description">
                    <span>由{{ HTML::link('#', $activity->user->username) }}于<span>{{ time2Units($activity->created_at) }}</span>发布</span>
                </div>
            </li>
            @endforeach
            {{ $activities->links() }}
        </ul>
        @endif
    </div>
    <div class="sidebar">
        @if (Auth::check())
        <div class="box">
            {{ HTML::link('/activity/create', '发布活动', array('class' => 'btn btn-info')) }}
        </div>
        @endif
        <div class="box">
            <div class="title">推荐活动</div>
            <ul class="content">
                @if ($relatedActivities->count() == 0)
                <li>暂无活动</li>
                @else
                @foreach($relatedActivities as $activity)
                <li>{{ HTML::link('activity/' . $activity->id, $activity->title) }}</li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
<div class="clearfix"></div>
@stop
@extends('layout.master')

@section('content')

<div class="content">
    <div class="topic">
        <div class="topic-header">
            <div class="avatar">
                <a href="{{ URL::to('/user/' . $activity->user->id) }}">
                    {{ HTML::image($activity->user->avatar ? $activity->user->avatar : '/images/default.jpg', '') }}
                </a>
            </div>
            <div class="title">
                {{ $activity->title }}
            </div>
            <div class="description">
                <span>由 {{ HTML::link('user/' . $activity->user->id, $activity->user->username) }} 于<span>{{ time2Units($activity->created_at) }}</span>发布</span>
            </div>
        </div>
        <div class="topic-content">
            {{$activity->description}}
        </div>
        @if ($activity->user->id != Auth::id())
        @if ($activity->hasOne(Auth::id()))
        {{ Form::open('activity/' . $activity->id . '/leave') }}
        {{ Form::submit('取消参加', array('class' => 'btn btn-primary btn-lg btn-block')) }}
        {{ Form::close() }}
        @else
        {{ Form::open('activity/' . $activity->id . '/participate') }}
        {{ Form::submit('参加', array('class' => 'btn btn-primary btn-lg btn-block')) }}
        {{ Form::close() }}
        @endif
        @endif
    </div>

    <div class="sidebar">
        <div class="box">
            <div class="title">相关活动</div>
            <ul class="content">
                @if ($relatedActivities->count() == 0)
                <li>暂无相关讨论</li>
                @else
                @foreach($relatedActivities as $activity)
                <li>{{ HTML::link('/activity/' . $activity->id, $activity->title) }}</li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>
    <!-- end of siderbar -->
    <div class="clearfix"></div>
</div>
@stop
@extends('layout.masternomsg')

@section('content')
<div class="content">
    <div class="rank-panel">
        <div class="rank-header">
            漏洞排行
        </div>
        @if($bugs->count() == 0)
        <div class="well text-center">暂无漏洞</div>
        @else
        <ul class="rank-list">
            <?php $i = 1 ?>
            @foreach($bugs as $bug)
            <li>
                <div class="rank-badge">
                    @if ($i == 1)
                    <span class="label label-danger">{{ $i++ }}</span>
                    @elseif($i == 2 || $i == 3)
                    <span class="label label-warning">{{ $i++ }}</span>
                    @else
                    <span class="label label-default">{{ $i++ }}</span>
                    @endif
                </div>
                <div class="rank-content">
                    <div class="title">
                        {{ HTML::link('/bug/' . $bug->id, $bug->name) }}
                    </div>
                    <div class="description">
                        <span>由{{ HTML::link('/user/' . $bug->user->id, $bug->user->username) }}于<span>{{ time2Units($bug->created_at) }}</span>发布</span>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        @endif
    </div>
    <div class="sidebar">
        <div class="box">
            <div class="title">用户排行</div>
            <ul class="ranks">
                @if($users->count() == 0)
                <li>暂无用户</li>
                @else
                <?php $i = 1 ?>
                @foreach($users as $user)
                <li>
                        @if ($i == 1)
                        <span class="label label-danger">{{ $i++ }}</span>
                        @elseif($i == 2 || $i == 3)
                        <span class="label label-warning">{{ $i++ }}</span>
                        @else
                        <span class="label label-default">{{ $i++ }}</span>
                        @endif
                    {{ HTML::link('/user' . $user->id, $user->username) }}
                </li>
                @endforeach
                @endif
            </ul>
        </div>
        <div class="box">
            <div class="title">软件排行</div>
            <ul class="ranks">
                @if(count($softwares) == 0)
                <li>暂无软件</li>
                @else
                <?php $i = 1 ?>
                @foreach($softwares as $software)
                <li>
                    @if ($i == 1)
                    <span class="label label-danger">{{ $i++ }}</span>
                    @elseif($i == 2 || $i == 3)
                    <span class="label label-warning">{{ $i++ }}</span>
                    @else
                    <span class="label label-default">{{ $i++ }}</span>
                    @endif
                    {{ $software->software }}
                </li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
@stop
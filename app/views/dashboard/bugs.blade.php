@extends('dashboard.layout')

@section('dashboard')

<div class="dashboard">
    <div class="dashboard-header">我的漏洞</div>
    <div class="dashboard-content">
        <ul class="lists">
            @foreach($bugs as $bug)
            <li class="list-item">
                <div class="list-item-content">
                    {{ HTML::link('/bug/' . $bug->id, $bug->name) }}
                    <span class="time">发布于{{ $bug->created_at }}</span>
                </div>
                <div class="list-item-footer">
                    {{ HTML::link('/bug/' . $bug->id . '#comments', '评论(' . count($bug->comments) . ')') }}
                    <a href="#">更新</a>
                    <a href="#">删除</a>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>

@stop
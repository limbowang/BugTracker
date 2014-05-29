@extends('layout.master')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="title pull-left">
            漏洞列表
        </div>
        <div class="sorts pull-left">
            <span class="lb">查看：</span>
            <ul>
                <li class="active">
                    最新
                </li>
                <li class="">
                    <a href="#">最热门</a>
                </li>
                <li class="">
                    <a href="#">评论最多</a>
                </li>
            </ul>
        </div>
        <div class="pull-right">
            @if (Auth::check())
            {{ HTML::link('/bug/create', '发布新漏洞', array('class' => 'btn btn-primary')) }}
            @endif
        </div>
        <div class="clearfix"></div>
    </div>
    <table class="table table-hover table-bordered">
        <thead>
        <tr class="success">
            <th>Publish date</th>
            <th>Bug name</th>
            <th>Related software</th>
            <th>Provider</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($bugs as $bug)
        <tr>
            <td>{{ $bug->created_at }}</td>
            <td>{{ HTML::link('/bug/' . $bug->id, $bug->name) }}</td>
            <td>{{ $bug->software }}</td>
            <td>{{ $bug->user->username }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $bugs->links() }}
</div>
@stop
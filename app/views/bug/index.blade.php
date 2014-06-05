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
                @foreach($sortlist as $sortkey=>$sortname)
                @if ($sort == $sortkey)
                <li class="active">
                    {{ $sortname }}
                </li>
                @else
                <li class="">
                    {{ HTML::link('/bug?sort=' . $sortkey, $sortname) }}
                </li>
                @endif
                @endforeach
            </ul>
        </div>
        <div class="pull-right">
            @if (Auth::check())
            {{ HTML::link('/bug/create', '发布新漏洞', array('class' => 'btn btn-primary')) }}
            @endif
        </div>
        <div class="clearfix"></div>
    </div>
    @if ($bugs->count() == 0)
    <div class="well text-center">暂无漏洞</div>
    @else
    <table class="table table-hover table-bordered">
        <thead>
        <tr class="success">
            <th>发布时间</th>
            <th>漏洞名称</th>
            <th>相关软件</th>
            <th>发布者</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($bugs as $bug)
        <tr>
            <td>{{ $bug->created_at }}</td>
            <td>{{ HTML::link('/bug/' . $bug->id, $bug->name) }}</td>
            <td>{{ $bug->software }}</td>
            <td>{{ HTML::link('/user/' . $bug->user->id, $bug->user->username) }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $bugs->appends(array('sort' => $sort))->links() }}
    @endif
</div>
@stop
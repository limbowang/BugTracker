@extends('layout.master')

@section('content')
<div class="content">
    <div class="page-header">
        <h4>Bug List</h4>
        {{ HTML::link('/bug/create', '发布新漏洞', array('class' => 'btn btn-primary btn-lg')) }}
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
</div>
@stop
@extends('dashboard.layout')

@section('dashboard')

<div class="dashboard">
    <div class="dashboard-header">我的漏洞</div>
    <div class="dashboard-content">
        @if (count($bugs) == 0)
            <span class="no-list">您还未发布任何漏洞</span>
        @else
        <ul class="lists">
            @foreach($bugs as $bug)
            <li class="list-item">
                <div class="list-item-content">
                    {{ HTML::link('/bug/' . $bug->id, $bug->name) }}
                    <span class="time">发布于{{ $bug->created_at }}</span>
                </div>
                <div class="list-item-footer">
                    {{ HTML::link('/bug/' . $bug->id . '#comments', '评论(' . count($bug->comments) . ')') }}
                    {{ HTML::link('/bug/' . $bug->id . '/edit', '更新') }}
                    <a href="javascript:void(0);" class="btn-delete" data-toggle="modal" data-target="#modal-delete"
                       data-item-id="bug-{{ $bug->id }}" data-item-title="{{ $bug->name }}">删除</a>
                </div>
            </li>
            @endforeach
        </ul>
        {{ $bugs->links() }}
        @endif
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <span class="modal-title" id="modalLabel">确认删除漏洞</span>
            </div>
            <div class="modal-footer">
                {{ Form::open(array('method'=>'DELETE', 'url'=>'', 'id' => 'form-delete')) }}
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="submit" class="btn btn-primary">删除</button>
                {{ Form::close() }}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop
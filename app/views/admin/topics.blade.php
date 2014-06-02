@extends('admin.layout')

@section('admin')

<div class="dashboard">
    <div class="dashboard-header">
        <span>所有话题</span>
        {{ Form::open(array('url' => '/topic', 'class' => 'form-horizontal-xs')) }}
        <input type="text" name="name" placeholder="请输入2~10个字符" value="{{ Input::old('name') }}"
               class="form-control form-field"/>
        <button class="btn btn-info btn-xs">添加</button>
        {{ Form::close() }}
    </div>
    <div class="dashboard-content">
        @if ($topics->count() == 0)
        <span class="no-list">没有话题</span>
        @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th>编号</th>
                <th>话题名称</th>
                <th>帖子数量</th>
            </tr>
            </thead>
            <tbody>
            @foreach($topics as $topic)
            <tr>
                <td>{{ $topic->id }}</td>
                <td>{{ HTML::link('/bbs?topic=' . $topic->name, $topic->name) }}</td>
                <td>{{ $topic->posts->count() }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ $topics->links() }}
        @endif
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <span class="modal-title" id="modalLabel">确认删除用户</span>
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
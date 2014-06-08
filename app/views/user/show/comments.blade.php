@extends('user.show')

@section('lists')

<ul class="lists">
    @if ($data->count() == 0)
    <li class="list-item">
        <div class="list-item-content">
            还未发布任何评论
        </div>
    </li>
    @else
    @foreach($data as $comment)
    <li class="list-item">
        <div class="list-item-content">
            <div class="status">
                <span>于<span class="time">{{ $comment->created_at }}</span>评论了漏洞{{ HTML::link('/bug/' . $comment->bug->id, $comment->bug->name) }}:</span>
            </div>
            <div class="quatation">{{ $comment->content }}</div>
        </div>
    </li>
    @endforeach
    @endif
</ul>

{{ $data->links() }}
@stop
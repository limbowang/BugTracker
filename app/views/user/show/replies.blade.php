@extends('user.show')

@section('lists')


<ul class="lists">
    @if ($data->count() == 0)
    <li class="list-item">
        <div class="list-item-content">
            还未发布任何回复
        </div>
    </li>
    @else
    @foreach($data as $reply)
    <li class="list-item">
        <div class="list-item-content">
            <div class="status">
                <span>于<span class="time">{{ $reply->created_at }}</span>评论了帖子{{ HTML::link('/bug/' . $reply->post->id, $reply->post->title) }}:</span>
            </div>
            <div class="quatation">{{ $reply->content }}</div>
        </div>
    </li>
    @endforeach
    @endif
</ul>

{{ $data->links() }}

@stop
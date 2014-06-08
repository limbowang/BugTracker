@extends('user.show')

@section('lists')

<ul class="lists">
    @if ($data->count() == 0)
    <li class="list-item">
        <div class="list-item-content">
            还未发布任何帖子
        </div>
    </li>
    @else
    @foreach($data as $post)
    <li class="list-item">
        <div class="list-item-content">
            {{ HTML::link('/bbs/' . $post->id, $post->title) }}
            <span class="time">发布于{{ $post->created_at }}</span>
        </div>
    </li>
    @endforeach
    @endif
</ul>

{{ $data->links() }}

@stop
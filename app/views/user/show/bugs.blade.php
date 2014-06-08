@extends('user.show')

@section('lists')

<ul class="lists">
    @if ($data->count() == 0)
    <li class="list-item">
        <div class="list-item-content">
           还未发布任何漏洞
        </div>
    </li>
    @else
    @foreach($data as $bug)
    <li class="list-item">
        <div class="list-item-content">
            {{ HTML::link('/bug/' . $bug->id, $bug->name) }}
            <span class="time">发布于{{ $bug->created_at }}</span>
        </div>
    </li>
    @endforeach
    @endif
</ul>

{{ $data->links() }}

@stop
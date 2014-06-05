@extends('layout.masternomsg')

@section('content')
<div class="content">
    <div class="search-box clearfix">
        <ul class="sorts">
            @foreach($sortlist as $sortkey=>$sortname)
            @if ($type == $sortkey)
            <li class="active sort-item">
                {{ $sortname }}
            </li>
            @else
            <li class="sort-item">
                {{ HTML::link('/search?type=' . $sortkey . '&keyword=' . $keyword, $sortname) }}
            </li>
            @endif
            @endforeach
        </ul>
            {{ Form::open(array('url' => '/search', 'method'=> 'get')) }}
            <div class="form-group col-lg-10">
                <input type="text" name="keyword" class="form-control" placeholder="搜索" value="{{ $keyword }}">
            </div>
            <input type="text" class="hidden" name="type" value="{{ $type }}"/>
            <input type="submit" class="btn btn-info col-lg-2" value="搜索"/>
            {{ Form::close() }}
    </div>
    @yield('search-result')
    <div class="clearfix"></div>
</div>
@stop
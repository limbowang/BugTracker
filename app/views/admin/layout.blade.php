@extends('layout.master')

@section('content')
<div class="content">
    @include('admin.sidebar')
    @yield('admin')
    <div class="clearfix"></div>
</div>

@stop
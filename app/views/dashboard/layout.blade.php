@extends('layout.master')

@section('content')
<div class="content">
    @include('dashboard.sidebar')
    @yield('dashboard')
    <div class="clearfix"></div>
</div>

@stop
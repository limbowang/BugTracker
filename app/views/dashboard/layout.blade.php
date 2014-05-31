@extends('layout.master')

@section('content')
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="content">
    @include('dashboard.sidebar')
    @yield('dashboard')
    <div class="clearfix"></div>
</div>

@stop
@extends('layout.master')

@section('content')
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="content">
    @include('dashboard.sidebar')
</div>

@stop
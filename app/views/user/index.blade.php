@extends('layout.master')

@section('content')

@foreach($users as $key => $value)
<tr>
    <td>{{ $value->id }}</td>
    <td>{{ $value->name }}</td>
    <td>{{ $value->email }}</td>

</tr>
@endforeach

@stop
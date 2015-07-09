@extends('admin.layout')
@section('content')
    <h1 class="page-header">Collections</h1>

    <table class="table">
        <tr>
            <td></td>
            <td>Name</td>
            <td>Slug</td>
        </tr>
        @foreach($collections as $collection)
        <tr>
            <td>{!! Form::checkbox('ids[]', $collection->id) !!}</td>
            <td>{{ $collection->name }}</td>
            <td>{{ $collection->slug }}</td>
        </tr>
        @endforeach
    </table>

    <nav class="text-center">
        {!! $collections->render() !!}
    </nav>
@stop


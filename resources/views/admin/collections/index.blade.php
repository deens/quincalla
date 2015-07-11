@extends('admin.layout')
@section('content')
        <div class="col-md-5">
            <h1 class="page-header">Collections</h1>
        </div>
        <div class="col-md-7 text-right">
            <a href="{{ route('admin.collections.create') }}" class="btn btn-primary">Add a collection</a>
        </div>

    <table class="table">
        <tr>
            <td></td>
            <td>Name</td>
            <td>Slug</td>
        </tr>
        @foreach($collections as $collection)
        <tr>
            <td>{!! Form::checkbox('ids[]', $collection->id) !!}</td>
            <td><a href="{{ route('admin.collections.edit', [$collection->id]) }}"> {{ $collection->name }} </a></td>
            <td>{{ $collection->slug }}</td>
        </tr>
        @endforeach
    </table>

    <nav class="text-center">
        {!! $collections->render() !!}
    </nav>
@stop


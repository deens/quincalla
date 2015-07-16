@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-md-5">
            <h1 class="page-header">Collections \ <small> Add a collection</small></h1>
        </div>
        <div class="col-md-7 text-right">
            <a href="{{ route('admin.collections.index') }}" class="btn btn-default">Back</a>
            <a href="{{ route('admin.collections.edit', [$collection->id]) }}" class="btn btn-default">Edit</a>
        </div>
    </div>

    <hr>
    <div class="row">

        <div class="col-md-8">

            <div class="form-group">
                <h3>{{ $collection->name }}</h3>
                <p>/collections/<small>{{ $collection->slug }}</small></p>
            </div>

            <h2>Products</h2>
            {{ var_dump($products) }}

        </div>

        <div class="col-md-4">

            <h4>Visibility</h4>
            <div class="form-group">
                <div class="checkbox">
                    <label class="control-label">
                        {!! Form::checkbox('published', true, old('published')) !!}
                        Online store
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="type" class="control-label">Date</label>
                <input type="text" class="form-control" name="publish_date" value="{{ old('publish_date') }}">
            </div>
            <div class="form-group">
                <label for="type" class="control-label">Time</label>
                <input type="text" class="form-control" name="publish_time" value="{{ old('publish_time') }}">
            </div>

            <h4>Collection Image</h4>
            <div class="form-group">
                {!! Form::label('image', 'Upload Image') !!}
                {!! Form::file('image', '', ['class' => 'form-control']) !!}
            </div>

            <hr>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('admin.collections.index') }}" class="btn btn-default">Cancel</a>
            {!! Form::submit('Save collection', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</form>
@stop

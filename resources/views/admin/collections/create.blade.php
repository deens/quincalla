@extends('admin.layout')
@section('content')
{!! Form::open(['route' => 'admin.collections.store', 'role' => 'form']) !!}
    <div class="row">
        <div class="col-md-5">
            <h1 class="page-header">Collections \ <small> Add a collection</small></h1>
        </div>
        <div class="col-md-7 text-right">
            <a href="{{ route('admin.collections.index') }}" class="btn btn-default">Cancel</a>
            {!! Form::submit('Save collection', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

    <hr>
    <div class="row">

        <div class="col-md-8">

            @include('admin.validation_errors')

            <div class="form-group">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('slug', 'Url identifier (/collections/{url-identifier})') !!}
                {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' => 'product-url-identifier']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description', old('description'), ['class' => 'form-control']) !!}
            </div>

            <h4>Conditions</h4>
            <div class="form-group">
                <div class="radio">
                    <label class="control-label">
                        {!! Form::radio('type', 'manual', true) !!}
                        Manually select products (you will be able to select products on the next page)
                    </label>
                </div>
                <div class="radio">

                    <label class="control-label">
                        {!! Form::radio('type', 'condition', old('condition')) !!}
                        Automaticly select products base on conditions.
                    </label>
                </div>
            </div>
            <div class="form-group">
                Products must match:
                <label class="radio-inline">
                  {!! Form::radio('match', 'all', true) !!} all conditions
                </label>
                <label class="radio-inline">
                  {!! Form::radio('match', 'any', false) !!} any condition
                </label>
            </div>

            @include('admin.collections.rules')

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
{!! Form::close() !!}
@stop

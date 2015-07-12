@extends('admin.layout')
@section('content')
{!! Form::model($collection, ['route' => ['admin.collections.update', $collection->id], 'method' => 'PATCH']) !!}
    <div class="row">
        <div class="col-md-5">
            <h1 class="page-header">Collections \ <small> Edit collection</small></h1>
        </div>
        <div class="col-md-7 text-right">
            <a href="{{ route('admin.collections.index') }}" class="btn btn-default">Cancel</a>
            {!! Form::submit('Update collection', ['class' => 'btn btn-primary']) !!}
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
                  {!! Form::radio('condition', 'all', true) !!} all conditions
                </label>
                <label class="radio-inline">
                  {!! Form::radio('condition', 'any', false) !!} any condition
                </label>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        {!! Form::select('rules_fields[]', [
                            'product_title'     => 'Product Title',
                            'product_type'      => 'Product Type',
                            'product_vendor'    => 'Product Vendor',
                            'product_price'     => 'Product Price',
                            'product_tag'       => 'Product Tag',
                            'compare_price'     => 'Compare price at',
                            'weitgh'            => 'Weitgh',
                            'inventory_stock'   => 'Inventory Stock',
                        ], null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::select('rules_conditions[]', [
                            'is_equal_to'       => 'is equal to',
                            'is_not_equal_to'   => 'is not equal to',
                            'is_greater_than'   => 'is greater than',
                            'is_less_than'      => 'is less than',
                            'start_with'        => 'start with',
                            'ends_with'         => 'ends with',
                            'contains'          => 'contains',
                            'does_not_contain'  => 'does not contain',
                        ], null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::text('rules_values[]', '', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        {!! Form::select('rules_fields[]', [
                            'Product Title', 
                            'Product Type',
                            'Product Vendor',
                            'Product Price',
                            'Product Tag',
                            'Compare price at',
                            'Weitgh',
                            'Inventory Stock',
                        ], null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::select('rules_relation[]', [
                            'is equal to', 
                            'is not equal to',
                            'is greater than',
                            'is less than',
                            'start with',
                            'ends with',
                            'contains',
                            'does not contain',
                        ], null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::text('rules_condition[]', '', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
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
                {!! Form::label('images', 'Upload Image') !!}
                {!! Form::file('image', '', ['class' => 'form-control']) !!}
            </div>

            <hr>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('admin.collections.index') }}" class="btn btn-default">Cancel</a>
            {!! Form::submit('Update collection', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</form>
{!! Form::close() !!}
@stop

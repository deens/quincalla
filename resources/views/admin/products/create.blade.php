@extends('admin.layout')
@section('content')
<form role="form" method="POST" action="{{ route('admin.products.store') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="row">
        <div class="col-md-5">
            <h1 class="page-header">Products \ <small> Add a product</small></h1>
        </div>
        <div class="col-md-7 text-right">
            <a href="{{ route('admin.products.index') }}" class="btn btn-default">Cancel</a>
            {!! Form::submit('Save product', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

    <hr>

    <div class="row">

        <div class="col-md-8">

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="form-group">
                {!! Form::label('name', 'Title') !!}
                {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description', old('description'), ['class' => 'form-control']) !!}
            </div>

            <h4>Images</h4>
            <div class="form-group">
                {!! Form::label('images', 'Upload Image') !!}
                {!! Form::file('image', '', ['class' => 'form-control']) !!}
            </div>

            <h4>Pricing</h4>
            <div class="form-group">
                {!! Form::label('price', 'Price') !!}
                {!! Form::text('price', old('price'), ['class' => 'form-control']) !!}

                {!! Form::label('compare_price', 'Compare at Price') !!}
                {!! Form::text('compare_price', old('compare_price'), ['class' => 'form-control']) !!}

                <div class="checkbox">
                    <label class="control-label">
                        <input type="checkbox"  name="charge_tax" value="{{ old('charge_tax') }}">Charge taxes on this product
                    </label>
                </div>
            </div>

            <h4>Inventory</h4>
            <div class="form-group">
                {!! Form::label('sku', 'SKU (Stock Keeping Unit)') !!}
                {!! Form::text('sku', old('sku'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('barcode', 'Barcode (ISBN, UPC, etc)') !!}
                {!! Form::text('barcode', old('barcode'), ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('inventory_policy', 'Inventory Policy') !!}
                {!! Form::select('inventory_policy',[
                    1 => 'Don\'t track inventory',
                    2 => 'Track this product Inventory'
                ], old('inventory_policy'), ['class' => 'form-control']) !!}
            </div>

        </div>
        <div class="col-md-4">

            <h4>Visibility</h4>
            <div class="form-group">
                <div class="checkbox">
                    <label class="control-label">
                        <input type="checkbox" name="visibility" value="{{ old('visibility') }}">
                        online store
                    </label>
                </div>
            </div>

            <h4>Organization</h4>
            <div class="form-group">
                <label for="type" class="control-label">Product Type</label>
                <input type="text" class="form-control" name="type" value="{{ old('type') }}">
            </div>
            <div class="form-group">
                <label for="type" class="control-label">Vendor</label>
                <input type="text" class="form-control" name="vendor" value="{{ old('vendor') }}">
            </div>

            <hr>

            <div class="form-group">
                <label for="type" class="control-label">Collections</label>
                <input type="text" class="form-control" name="collections" value="{{ old('collections') }}">
            </div>
            <div class="form-group">
                <label for="type" class="control-label">Tags</label>
                <input type="text" class="form-control" name="tags" value="{{ old('tags') }}">
            </div>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('admin.products.index') }}" class="btn btn-default">Cancel</a>
            {!! Form::submit('Save product', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</form>
@stop



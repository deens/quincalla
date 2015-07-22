@extends('admin.layout')
@section('content')
{!! Form::open(['route' => 'admin.products.store', 'role' => 'form']) !!}
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

            @include('admin.validation_errors')

            <div class="form-group">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('slug', 'Url identifier (/product/{url-identifier})') !!}
                {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' => 'product-url-identifier']) !!}
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

            <div class="form-group">
                {!! Form::label('quantity', 'Quantity') !!}
                {!! Form::text('quantity', old('quantity'), ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <div class="checkbox">
                    <label class="control-label">
                        <input type="checkbox" name="inventory_policy" value="{{ old('inventory_policy') }}">
                        Allow customers to purchase this product when it's out of stock
                    </label>
                </div>
            </div>


            <h4>Shipping</h4>
            <div class="form-group">
                {!! Form::label('weight', 'Weight') !!}
                {!! Form::text('weight', old('weight'), ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('weight_unit', 'Weight Unit') !!}
                {!! Form::select('weight_unit', [
                1 => 'lb',
                2 => 'oz',
                3 => 'kg',
                4 => 'g',
                ], old('weight_unit'), ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <div class="checkbox">
                    <label class="control-label">
                        <input type="checkbox" name="inventory_policy" value="{{ old('inventory_policy') }}">
                        This product require shipping
                    </label>
                </div>
            </div>

        </div>

        <div class="col-md-4">

            <h4>Visibility</h4>
            <div class="form-group">
                <div class="checkbox">
                    <label class="control-label">
                        {!! Form::checkbox('published', true, old('published') ?: true) !!}
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

            <h4>Organization</h4>
            <div class="form-group">
                <label for="type" class="control-label">Product Type</label>
                {!! Form::text('type', old('type'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label for="vendor" class="control-label">Vendor</label>
                {!! Form::text('vendor', old('vendor'), ['class' => 'form-control']) !!}
            </div>

            <hr>

            <div class="form-group">
                <label for="type" class="control-label">Collections</label>
                {!! Form::select('collections[]', $collections, old('collections[]'), ['class' => 'form-control', 'multiple', 'id' => 'collections-list']) !!}
            </div>
            <div class="form-group">
                <label for="type" class="control-label">Tags</label>
                {!! Form::select('tags[]', $tags, old('tags[]'), ['class' => 'form-control', 'multiple', 'id' => 'tags-list'] ) !!}
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
{!! Form::close() !!}
@stop

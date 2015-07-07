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

            <!-- {!! Form::label('compare_price', 'Compare at Price') !!} -->
            <!-- {!! Form::text('compare_price', old('compare_price'), ['class' => 'form&#45;control']) !!} -->

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
                    <input type="checkbox" name="visibility" value="{{ old('visibility') }}">
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

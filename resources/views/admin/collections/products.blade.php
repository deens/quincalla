<h4>Products</h4>

@if ($collection->type === 'manual')
    <div class="col-md-8">
        {!! Form::label('product_query', 'Search by product name') !!}
        <input type="text" name="product_query" id="product-query" class="form-control" placeholder="Product name">
    </div>
    <div class="col-md-4">
        {!! Form::label('sort_order', 'Sort By') !!}
        {!! Form::select('sort_order', $sortOptions, null, ['class' => 'form-control']) !!}
    </div>
@else
    <div class="form-group">
        {!! Form::label('sort_order', 'Sort By') !!}
        {!! Form::select('sort_order', $sortOptions, null, ['class' => 'form-control']) !!}
    </div>
@endif

<table class="table">
    @if ($products->count())
        @foreach ($products as $product)
            <tr>
                <td><img src="http://placehold.it/30x30" alt="{{ $product->name }}"></td>
                <td>{{ $product->name }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td>
                <h4 class="alert alert-danger">No products have been assigned to this collection</h4>
            </td>
        </tr>
    @endif
</table>

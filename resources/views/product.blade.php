@extends('app')

@section('content')

<div class="container">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-5">
            <div class="thumbnail">
                <img src="http://placehold.it/420x420" alt="">
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-7">
            <h1>{{ $product->name }}</h1>

            <div class="description">
                <p>{{ $product->description }}</p>
            </div>

            <hr>

            <div class="pricing">
                <div class="row">
                    <!-- Price -->
                    <div class="col-md-4">
                        <h4>{!! $product->present()->format_price !!}</h4>
                    </div>

                    <!-- Add to cart -->
                    <div class="col-md-8">
                        {!! Form::open(['route' => 'cart.store', 'method' => 'POST', 'class' => 'form-inline']) !!}
                        {!! Form::hidden('product', $product->slug) !!} 
                        <div class="form-group">
                            {!! Form::label('qty', 'Quantity:') !!}
                            {!! Form::text('qty', '1', ['class' => 'form-control']) !!} 
                            {!! Form::submit('Add To Shopping Cart', ['class' => 'btn btn-danger']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
@stop

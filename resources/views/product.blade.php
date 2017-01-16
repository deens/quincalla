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
                        {!! Form::hidden('qty', 1) !!}
                        <div class="form-group">
                            {!! Form::submit('Add To Cart', ['class' => 'btn btn-primary']) !!}
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

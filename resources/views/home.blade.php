@extends('app')
@section('content')

    <!-- Jumbotron Header -->
    <header class="jumbotron hero-spacer">
        <div class="container text-center">
            <h1>Welcome to Quincalla!</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
            <p><a class="btn btn-primary btn-large">Call to action!</a></p>
        </div>
    </header>

    <div class="container">
        <hr>

        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-center">New Products</h3>
            </div>
        </div>

        <div class="row text-center">
            @foreach($products as $product)
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="http://placehold.it/800x500" alt="">
                    <div class="caption">
                        <h3><a href="{{ route('products.show', [$product->slug]) }}">{{ $product->name }}</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href="{{ route('products.show', [$product->slug]) }}" class="btn btn-primary">Buy Now!</a> <a href="{{ route('products.show', [$product->slug]) }}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <hr>

        @if ($collections->count())
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center">Our Categories</h3>
                </div>
            </div>
            <div class="row text-center">

            @foreach($collections as $collection)
                <div class="col-md-3 col-sm-6 hero-feature">
                    <div class="thumbnail">
                        <img src="http://placehold.it/800x500" alt="">
                        <div class="caption">
                            <h4><a href="{{ route('collections.show', [$collection->slug])}}">{{ $collection->name }}</a></h4>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        @endif
    </div>
@stop

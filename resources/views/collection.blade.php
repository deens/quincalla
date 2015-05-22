@extends('app')
@section('content')
<!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <h2>Collections</h2>
                <div class="list-group">
                    @foreach($collections as $nav)
                        <a href="{{ route('collections.show', [$nav->slug]) }}" class="list-group-item">{{ $nav->name }}</a>
                    @endforeach
                </div>
            </div>

            <div class="col-md-9">
                <h2>{{ $collection->name }}</h2>
                <div class="row">
                    @if ($products->count())
                    @foreach($products as $product)
                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail">
                                <a href="{{ route('products.show', [$product->slug]) }}">
                                    <img src="http://placehold.it/320x150" alt="">
                                </a>
                                <div class="caption">
                                    <h4 class="text-center">
                                        <a href="{{ route('products.show', [$product->slug]) }}">{{ $product->name }}</a>
                                    </h4>
                                    <h4 class="text-center">{{ $product->present()->format_price}}</h4>
                                </div>
                                <hr>
                                <div class="ratings">
                                    <p class="pull-right">15 reviews</p>
                                    <p>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @else
                        <div class="col-md-12">
                            <div class="well text-center">
                                <h2>Not Products Found</h2>
                            </div>
                        </div>
                    @endif
                </div>

                <nav>
                    <ul class="pager">
                        <li class="previous"><a href="#"><span aria-hidden="true">&larr;</span> Older</a></li>
                        <li class="next"><a href="#">Newer <span aria-hidden="true">&rarr;</span></a></li>
                    </ul>
                </nav>
            </div>

        </div>

    </div>
@stop


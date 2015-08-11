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
                    @foreach($products as $key=>$product)
                        <div class="col-sm-6 col-lg-4 col-md-4">
                            <div class="thumbnail">
                                <a href="{{ route('products.show', [$product->slug]) }}">
                                    <img src="http://placehold.it/320x150" alt="">
                                </a>
                                <div class="caption">
                                    <h4 class="text-center">
                                        <a href="{{ route('products.show', [$product->slug]) }}">{{ $product->name }}</a>
                                    </h4>
                                    <h4 class="text-center">{!! $product->present()->format_price !!}</h4>
                                </div>
                            </div>
                        </div>
                        @if (($key + 1) % 3 == 0)
                            <div class="clearfix hidden-sm"></div>
                        @endif
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
                    {!! $products->render() !!}
                </nav>
            </div>

        </div>

    </div>
@stop

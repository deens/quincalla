@extends('app')
@section('content')
<!-- Page Content -->
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h2>Search results for `{{ $query or '*'}}`</h2>
                <div class="well">
                    {!! Form::open(['route' => 'search.index', 'method' => 'get', 'class' => 'form-inline', 'role' => 'search']) !!}
                        <div class="form-group">
                          <input type="text" name="query" value="{{ $query or ''}}" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">Search</button>
                    {!! Form::close() !!}
                </div>
                <div class="row">
                    @if ($results->count())
                    @foreach($results as $product)
                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail">
                                <a href="{{ route('products.show', [$product->slug]) }}">
                                    <img src="http://placehold.it/800x500" alt="">
                                </a>
                                <div class="caption">
                                    <h4><a href="{{ route('products.show', [$product->slug]) }}">{{ $product->name }}</a></h4>
                                    <h4> {!! $product->present()->format_price !!}</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @else
                        <div class="col-md-12">
                            <div class="well text-center">
                                <h2 class="text-danger">Not Products Found</h2>
                            </div>
                        </div>
                    @endif
                </div>

                <nav>
                    {!! $results->appends(['query' => $query])->render() !!}
                </nav>
            </div>

        </div>

    </div>
@stop



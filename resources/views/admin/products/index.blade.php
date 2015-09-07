@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-md-5">
            <h1 class="page-header">Products</h1>
        </div>
        <div class="col-md-7 text-right">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add a product</a>
        </div>
    </div>
    <table class="table">
        <tr>
            <td></td>
            <td></td>
            <td>Name</td>
            <td>Inventory</td>
            <td>Price</td>
            <td></td>
        </tr>
        @foreach($products as $product)
        <tr>
            <td>{!! Form::checkbox('ids[]', $product->id) !!}</td>
            <td>
                <img src="http://placehold.it/30x30" alt="">
            </td>
            <td>
                <a href="{{ route('admin.products.edit', [$product->id]) }}"> {{ $product->name }}</a>
            </td>
            <td>N/A</td>
            <td>
                {!! $product->present()->format_price !!}
            </td>
        </tr>
        @endforeach
    </table>
    <nav class="text-center">
        {!! $products->render() !!}
    </nav>

@stop


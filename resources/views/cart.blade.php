@extends('app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if($products->count())
            <div class="row">
                <div class="col-md-9">
                    <h1>Shopping Cart </h1>
                    {!! Form::open(['route' => ['cart.update'], 'method' => 'put', 'class' => 'form-inline']) !!}

                    <table class="table">
                        <tr>
                            <th></th>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                        @foreach($products as $product)
                            <tr>
                                <td><img src="http://placehold.it/50x50" alt=""></td>
                                <td>
                                    <p><a href="{{ route('products.show', [$product->product->slug])}}">{{ $product->name }}</a></p>
                                </td>
                                <td>
                                    <p>${{ $product->price }}</p>
                                </td>
                                <td>
                                    <div class="form-group">
                                        {!! Form::text('quantities['.$product->rowid.']', $product->qty, ['class' => 'form-control input-sm']) !!}
                                    </div>
                                </td>
                                <td>
                                    <p>${{ $product->subtotal }}</p>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <a class="btn btn-danger btn-sm" title="Delete" href="{{ route('cart.remove', [$product->rowid]) }}">remove</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    {!! Form::submit('Update Cart', ['class' => 'btn btn-default']) !!}
                    <a class="btn btn-default" href="{{ route('cart.destroy') }}">Empty Shopping Cart</a>
                    {!! Form::close() !!}

                </div>

                <div class="col-md-3">
                    <h4>Order Summary</h4>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Item(s) Total</td>
                                <td>${{ number_format($cartTotal, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Shipping</td>
                                <td>$0.00</td>
                            </tr>
                            <tr>
                                <td>Tax</td>
                                <td>$0.00</td>
                            </tr>
                            <tr>
                                <td><h4>Total</h4></td>
                                <td><h4>${{ number_format($cartTotal, 2) }}</h4></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center">
                        <a class="btn btn-lg btn-block btn-danger" href="{{ route('order.index') }}">Continue to checkout</a>

                        <p><a href="{{ url('/')}}">Continue Shopping</a></p>
                    </div>

                </div>
            </div>
        </div>
    @else

    <h1>Shopping Cart</h1>

    <div class="well">
        <h2 class="text-center">
            Your shopping cart is empty.
        </h2>
        <div class="text-center">
            <a class="btn btn-lg btn-danger " href="{{ url('/')}}"> Continue Shopping</a>
        </div>
    </div>

    @endif
</div>

@stop

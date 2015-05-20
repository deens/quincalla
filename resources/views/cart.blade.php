@extends('app')
@section('content')
<div class="container">
    <h1>Shopping Bag</h1>
    @if($products->count())
    <table class="table">
        @foreach($products as $product)
        <tr>
            <td><img src="http://placehold.it/50x50" alt=""></td>
            <td>
                <p><a href="">{{ $product->name }}</a></p>
            </td>
            <td>
                {!! Form::open(['route' => ['cart.update', $product->rowid], 'method' => 'put', 'class' => 'form-inline']) !!}
                    <div class="form-group">
                        {!! Form::text('qty', $product->qty, ['class' => 'form-control input-sm']) !!}
                        {!! Form::submit('Update', ['class' => 'btn btn-default']) !!}
                    </div>
                {!! Form::close() !!}
            </td>
            <td>
                <p>${{ $product->price }}</p>
            </td>
            <td>
                {!! Form::open(['route' => ['cart.destroy', $product->rowid], 'method' => 'delete', 'class' => 'form-inline']) !!}
                    <div class="form-group">
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    </div>
                {!! Form::close() !!}
            </td>
            <td>
                <p>${{ $product->subtotal }}</p>
            </td>
        </tr>
        @endforeach
    </table>

    <hr>
    <div class="row">
        <div class="col-md-4 col-md-offset-8">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td><h4>Subtotal</h4></td>
                        <td><h4>${{ $cartTotal }}</h4></td>
                    </tr>
                    <tr>
                        <td>Shipping</td>
                        <td>$00.00</td>
                    </tr>
                    <tr>
                        <td>Tax</td>
                        <td>$00.00</td>
                    </tr>
                    <tr>
                        <td><h4>Total</h4></td>
                        <td><h4>${{ $cartTotal }}</h4></td>
                    </tr>
                </tbody>
            </table>

            <div class="text-right">
                <a class="text-left" href="">continue shopping</a>
                <a class="btn btn-lg btn-danger " href="">Checkout</a>
            </div>
        </div>
    </div>

    <hr>

    @else

        <div class="well">
            <h2 class="text-center">
                Your shopping bag is empty.
            </h2>
            <div class="text-center">
                <a class="btn btn-lg btn-danger " href="{{ url('/')}}"> Continue Shopping</a>
            </div>
        </div>

    @endif
</div>

@stop

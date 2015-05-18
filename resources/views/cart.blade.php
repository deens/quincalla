@extends('app')
@section('content')
<div class="container">
    <h1>Shopping Bag</h1>
    <table class="table">
            <tr>
                <td><img src="http://placehold.it/50x50" alt=""></td>
                <td>
                    <p><a href="">First product</a></p>
                </td>
                <td>
                    <form class="form-inline">
                        <div class="form-group">
                            <input class="form-control input-sm" type="text" value="1">
                            <button class="btn btn-sm">Update</button>
                        </div>
                    </form>
                </td>
                <td>
                    <a href="">remove</a>
                </td>
                <td>
                    <p>$99.99</p>
                </td>
            </tr>
            <tr>
                <td><img src="http://placehold.it/50x50" alt=""></td>
                <td>
                    <p><a href="">First product</a></p>
                </td>
                <td>
                    <form class="form-inline">
                        <div class="form-group">
                            <input class="form-control input-sm" type="text" value="1">
                            <button class="btn btn-sm">Update</button>
                        </div>
                    </form>
                </td>
                <td>
                    <a href="">remove</a>
                </td>
                <td>
                    <p>$99.99</p>
                </td>
            </tr>
    </table>
    <hr>
    <div class="row">
        <div class="col-md-4 col-md-offset-8">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td><h4>Subtotal</h4></td>
                        <td><h4>$99.00</h4></td>
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
                        <td><h4>$99.00</h4></td>
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

    <div class="well">
        <h2 class="text-center">
            Your shopping bag is empty.
        </h2>
        <div class="text-center">
            <a class="btn btn-lg btn-danger " href="{{ url('/')}}"> Continue Shopping</a>
        </div>
    </div>
</div>

@stop

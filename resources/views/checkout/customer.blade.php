@extends('checkout')
@section('content')
    <h2>Quincalla <small>Checkout</small></h2>
    <div class="row">

        <div class="col-md-6">

            <h3>New Customer</h3>
            <p>Dont have an account? Pick one of the options below.</p>

            {!! Form::open(['route' => 'checkout']) !!}
                <div class="radio">
                    <label><input value="" name="acnt-opt" type="radio" checked="">Register Account</label>
                </div>
                <div class="radio">
                    <label><input value="" name="acnt-opt" type="radio">Checkout as guest</label>
                </div>

                <p>Register with us for a fast and easy checkout and easy access to your order history and status</p>
                <button class="btn btn-default btn-bigger">Continue to checkout</button>
            {!! Form::close() !!}
        </div>

        <div class="col-md-6">

            <h3>Returning Customers</h3>

            {!! Form::open(['route' => 'checkout']) !!}

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" class="form-control" placeholder="Enter email">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="password">
                </div>

                <div class="form-group">
                    <label class="checkbox-inline"><input type="checkbox" value="">Remember me </label>
                </div>

                <button class="btn btn-default btn-bigger">Sign in</button>

            {!! Form::close() !!}

        </div>
    </div>
@stop

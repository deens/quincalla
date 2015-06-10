@extends('app')
@section('content')
<div class="container">

    <h2>Quincalla <small>Checkout</small></h2>
    <div class="row">

        <div class="col-md-6">

            <h3>New Customer</h3>
            <p>Dont have an account? Pick one of the options below.</p>

            {!! Form::open(['route' => 'checkout.customer']) !!}

                <div class="radio">
                    <label><input value="new" name="account_type" type="radio" checked="">Register Account</label>
                </div>

                <div class="radio">
                    <label><input value="guest" name="account_type" type="radio">Checkout as guest</label>
                </div>

                <p>Register with us for a fast and easy checkout and easy access to your order history and status</p>

                <button class="btn btn-default btn-bigger">Continue to checkout</button>
            {!! Form::close() !!}
        </div>

        <div class="col-md-6">

            <h3>Returning Customers</h3>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::open(['route' => 'checkout.customer']) !!}

                {!! Form::hidden('account_type', 'existing') !!}

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter email">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="password">
                </div>

                <div class="form-group">
                    <label class="checkbox-inline"><input type="checkbox" value="">Remember me </label>
                </div>

                <button class="btn btn-default btn-bigger">Sign in</button>

            {!! Form::close() !!}

        </div>
    </div>
</div>
@stop

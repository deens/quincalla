@extends('app')
@section('content')
<div class="container">

    <h2>Checkout</h2>

    @include('order.steps')

    <div class="row">

        <div class="col-md-6">

            <h3>New Customer</h3>
            <p>Don't have an account?</p>

            <p>Register with us for a fast and easy checkout and easy access to your order history and status</p>

            <a class="btn btn-primary btn-bigger" href="{{ route('order.register')}}">Continue as New Customer</a>
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

            {!! Form::open(['route' => 'order.customer']) !!}

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

                <button class="btn btn-default btn-bigger">Sign in to checkout</button>

            {!! Form::close() !!}

        </div>
    </div>
</div>
@stop

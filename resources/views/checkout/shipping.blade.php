@extends('checkout')
@section('content')
<h1>Checkout <small>Shipping Information</small></h1>
<div class="panel-body">
    {!! Form::open(['route' => 'checkout.shipping']) !!}
        <div class="row">
            <h3>Shipping Address</h3>

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

            <div class="col-md-6">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" placeholder="Enter first name">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Second Name</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Enter last name">
                </div>
            </div>
            @if ($account_type !== 'existing')
            <div class="col-md-12">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter Email address">
                </div>
            </div>
            @endif

            @if ($account_type === 'new')

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Enter confirm password">
                    </div>
                </div>

            @endif

            <div class="col-md-6">
                <div class="form-group">
                    <label>Address Line 1</label>
                    <input type="text" name="address" class="form-control" placeholder="Enter Address">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Address Line 2</label>
                    <input type="text" name="address1" class="form-control" placeholder="Enter Apt.">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Country</label>
                    <select name="country" class="form-control">
                        <option>USA</option>
                        <option>England</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>City / Town</label>
                    <select name="state" class="form-control">
                        <option>Select city</option>
                        <option>California</option>
                        <option>Florida</option>
                        <option>New York</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone"class="form-control" placeholder="Enter phone">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Postal Code</label>
                    <input type="text" name="zipcode" class="form-control" placeholder="Enter zipcode">
                </div>
            </div>

        </div>

        <div class="form-group">
            {!! Form::submit('Continue to payment', ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    {!! Form::close() !!}

    {{ var_dump($checkout) }}
</div>
@stop

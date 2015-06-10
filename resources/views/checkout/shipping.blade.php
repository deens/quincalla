@extends('checkout')
@section('content')
<h1>Checkout <small>Shipping Information</small></h1>
<div class="panel-body">
    {!! Form::open(['route' => 'checkout.shipping']) !!}
        <div class="row">
            <h3>Shipping Address</h3>
            {{ var_dump($checkout) }}
            <div class="col-md-6">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" placeholder="Enter Name">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Second Name</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Enter Name">
                </div>
            </div>
            @if ($account_type !== 'existing')
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter Email address">
                </div>
            </div>
            @endif

            <div class="col-md-12">
                <div class="form-group">
                    <label>Address Line 1</label>
                    <input type="text" name="address" class="form-control" placeholder="Enter Name">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>Address Line 2</label>
                    <input type="text" name="address1" class="form-control" placeholder="Enter Name">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Country</label>
                    <select name="country" class="form-control">
                        <option>Select country</option>
                        <option>England</option>
                        <option>Germany</option>
                        <option>France</option>
                        <option>Spain</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>City / Town</label>
                    <select name="city" class="form-control">
                        <option>Select city</option>
                        <option>New York</option>
                        <option>Paris</option>
                        <option>Nairobi</option>
                        <option>Cairo</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone"class="form-control" placeholder="Enter Name">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Postal Code</label>
                    <input type="text" name="zipcode" class="form-control" placeholder="Enter Name">
                </div>
            </div>

        </div>

        <div class="form-group">
            {!! Form::submit('Continue to payment', ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    {!! Form::close() !!}

</div>
@stop

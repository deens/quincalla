@extends('checkout')
@section('content')
    <h1>Checkout <small>Shipping Information</small></h1>
    <hr>
    <h3>Shipping Address</h3>
    <br>
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

    {!! Form::open(['route' => 'checkout.shipping']) !!}
    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('first_name', 'First Name') !!}
                {!! Form::text('first_name', $first_name, ['class' => 'form-control', 'placeholder' => 'Enter first name']) !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('last_name', 'Second Name') !!}
                {!! Form::text('last_name', $last_name, ['class' => 'form-control', 'placeholder' => 'Enter last name']) !!}
            </div>
        </div>

        @if ($account_type !== 'customer')
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('account_email', 'Email Address') !!}
                {!! Form::text('account_email', $account_email, ['class' => 'form-control', 'placeholder' => 'Enter Email address']) !!}
            </div>
        </div>
        @endif

        @if ($account_type === 'new-customer')

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter password']) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Confirm Password') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Enter confirm password']) !!}
                </div>
            </div>

        @endif

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('address', 'Address Line 1') !!}
                {!! Form::text('address', $address, ['class' => 'form-control', 'placeholder' => 'Street address, P.O. box, etc.']) !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('address1', 'Address Line 2') !!}
                {!! Form::text('address1', $address1, ['class' => 'form-control', 'placeholder' => 'Apartment, suite, unit, building, floor, etc.']) !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('city', 'City') !!}
                {!! Form::text('city', $city, ['class' => 'form-control', 'placeholder' => 'Enter city']) !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('state', 'State/Province/Region') !!}
                {!! Form::select('state', $states, $state, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('country', 'Country') !!}
                {!! Form::select('country', $countries, $country, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('zipcode', 'Zip Code') !!}
                {!! Form::text('zipcode', $zipcode, ['class' => 'form-control', 'placeholder' => 'Enter zipcode']) !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('phone', 'Phone Number') !!}
                {!! Form::text('phone', $phone, ['class' => 'form-control', 'placeholder' => 'Enter phone']) !!}
            </div>
        </div>

    </div>

    <div class="form-group">
        {!! Form::submit('Continue to payment', ['class' => 'btn btn-lg btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@stop

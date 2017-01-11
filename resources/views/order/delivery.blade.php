@extends('app')
@section('content')

<div class="container">

    @include('order.steps')

    <div class="col-md-8">
        <h1>Your delivery address and shipping</h1>

        {!! Form::open(['route' => 'order.delivery.store']) !!}
        <h3>Your delivery address</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('name', 'Full name') !!}
                    {!! Form::text('name', $address->name, ['class' => 'form-control', 'placeholder' => 'Your Name']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('address', 'Address Line 1') !!}
                    {!! Form::text('address', $address->address, ['class' => 'form-control', 'placeholder' => 'Street address, P.O. box, etc.']) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('address1', 'Address Line 2') !!}
                    {!! Form::text('address1', $address->address1, ['class' => 'form-control', 'placeholder' => 'Apartment, suite, unit, building, floor, etc.']) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('city', 'City') !!}
                    {!! Form::text('city', $address->city, ['class' => 'form-control', 'placeholder' => 'Enter city']) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('state', 'State/Province/Region') !!}
                    {!! Form::select('state', $states, $address->state, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('country', 'Country') !!}
                    {!! Form::select('country', $countries, $address->country, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('zipcode', 'Zip Code') !!}
                    {!! Form::text('zipcode', $address->zipcode, ['class' => 'form-control', 'placeholder' => 'Enter zipcode']) !!}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('phone', 'Phone Number') !!}
                    {!! Form::text('phone', $address->phone, ['class' => 'form-control', 'placeholder' => 'Enter phone']) !!}
                </div>
            </div>
        </div>

        <h3> Select your delivery method</h3>

        <div class="radio">
            <label>
                {!! Form::radio('shipping_method', 'free_shipping') !!}
                Free shipping
            </label>

        </div>

        <div class="radio">
            <label>
                {!! Form::radio('shipping_method', 'premium_shippping') !!}
                Premium shipping
            </label>

        </div>

        <div class="form-group">
            {!! Form::submit('Continue to payment', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>

    <div class="col-md-4">
    
    </div>

</div>

@stop

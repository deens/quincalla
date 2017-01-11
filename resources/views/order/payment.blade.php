@extends('app')
@section('content')
<div class="container">

    @include('order.steps')

    {!! Form::open(['route' => 'order.payment.store', 'id' => 'payment-form']) !!}
    <div class="row">
        <div class="col-md-8">
            <h1>Payment</h1>

            <h3> Billing Address</h3>

            <div class="checkbox">
                <label>
                    <input id="same_address" name="same_address" type="checkbox" value="1" {{ $sameAddress ? 'checked' : '' }}> Use my shipping address as my billing address
                </label>
                <hr>
            </div>

            <div class="row billing-address">

                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('name', 'Full Name') !!}
                        {!! Form::text('name', $address->name, ['class' => 'form-control', 'placeholder' => 'Enter your full name']) !!}
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
            </div>


            <h3>Credit Card Payment</h3>

            <div class="alert alert-danger payment-errors"></div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="cardNumber">Card number</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="card_number" placeholder="Valid Card Number" data-stripe="number" autocomplete="cc-number" required autofocus />
                            <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-7 col-md-7">
                    <div class="form-group">
                        <label for="card-expiry"><span class="hidden-xs">Expiration</span><span class="visible-xs-inline">Exp</span> date</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="exp-month" data-stripe="exp-month"  placeholder="01" required />
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="exp-year" data-stripe="exp-year"  placeholder="2015" required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-5 col-md-5 pull-right">
                    <div class="form-group">
                        <label for="cvc">CVC</label>
                        <input type="text" class="form-control" name="cvc" data-stripe="cvc" placeholder="CVC" autocomplete="cc-csc" required />
                    </div>
                </div>

            </div>

            <!-- <div class="row"> -->
            <!--     <div class="col&#45;xs&#45;12"> -->
            <!--         <button class="btn btn&#45;success btn&#45;lg btn&#45;block" type="submit">Start Subscription</button> -->
            <!--     </div> -->
            <!-- </div> -->
            <div class="row" style="display:none;">
                <div class="col-xs-12">
                    <p class="payment-errors"></p>
                </div>
            </div>

            {!! Form::submit('Continue to confirmation', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>

        <div class="col-md-4">

        </div>
    </div>
</div>
@stop


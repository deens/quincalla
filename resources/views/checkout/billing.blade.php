@extends('checkout')
@section('content')
    <h1>Payment & Billing</h1>
    <hr>
    <h3>Payment Information</h3>
    <div class="row">

        {!! Form::open(['route' => 'checkout.billing']) !!}
        <div class="col-md-6">
            <div class="form-group">
                <label>Name on card</label>
                <input type="text" name="name_on_cart" class="form-control" placeholder="Enter Name">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Credit card number</label>
                <input type="text" name="cart_number" class="form-control" placeholder="Enter Name">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Card Type</label>
                <select name="cart_type" class="form-control">
                    <option>Select Cart Type</option>
                    <option>American Express</option>
                    <option>Discover</option>
                    <option>MasterCard</option>
                    <option>Visa</option>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
            <label>Expiration date</label>
            <div class="row">
                <div class="col-md-6">
                    <select name="expiration_date_month" class="form-control">
                        <option>01</option>
                        <option>02</option>
                        <option>03</option>
                        <option>04</option>
                        <option>05</option>
                        <option>06</option>
                        <option>07</option>
                        <option>08</option>
                        <option>09</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <select name="expiration_date_year" class="form-control">
                        <option>2015</option>
                        <option>2016</option>
                        <option>2017</option>
                        <option>2018</option>
                        <option>2019</option>
                    </select>
                </div>
            </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>CCV Code</label>
                <input type="text" name="ccv_code" class="form-control" placeholder="3 digits only">
            </div>
        </div>


    </div>
    <div class="checkbox">
        <label>
            <input name="same_address" type="checkbox" value="true"> Use my shipping address as my billing address
        </label>
        <hr>
    </div>
    <h3>Billing Address</h3>

    <div class="row">

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

        <div class="form-group">
            <label>Address Line 1</label>
            <input type="text" name="address" class="form-control" placeholder="Enter Name">
        </div>

        <div class="form-group">
            <label>Address Line 2</label>
            <input type="text" name="address1" class="form-control" placeholder="Enter Name">
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Country</label>
                <select name="country" class="form-control">
                    <option>Select country</option>
                    <option>USA</option>
                    <option>England</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>City / Town</label>
                <select name="city" class="form-control">
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
                <input type="text" name="phone" class="form-control" placeholder="Enter Name">
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
        {!! Form::submit('Continue to confirm', ['class' => 'btn btn-lg btn-primary']) !!}
    </div>
    {!! Form::close() !!}

    {{ var_dump($checkout) }}
@stop

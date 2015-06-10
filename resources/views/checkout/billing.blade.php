@extends('checkout')
@section('content')
    <h1>Payment & Billing</h1>
    <hr>
    {{ var_dump($checkout) }}
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
                    <option>Select country</option>
                    <option>England</option>
                    <option>Germany</option>
                    <option>France</option>
                    <option>Spain</option>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Expiration date</label>
                <select name="expiration_date" class="form-control">
                    <option>Select city</option>
                    <option>New York</option>
                    <option>Paris</option>
                    <option>Nairobi</option>
                    <option>Cairo</option>
                </select>
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
            <input name="same_address" type="checkbox"> Use my shipping address as my billing address
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
@stop

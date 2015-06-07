@extends('checkout')
@section('content')
<h1>Checkout <small>Shipping Information</small></h1>
<div class="panel-body">
    {!! Form::open(['route' => 'checkout.shipping']) !!}
        <div class="row">
            @if ($checkout['account_type'] === 'guest')

                <h3>Contact Information</h3>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="account_first_name" class="form-control" placeholder="Enter Name">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="account_last_name" class="form-control" placeholder="Enter Name">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="account_email" class="form-control" placeholder="Enter Email">
                    </div>
                </div>

            @endif

            @if ($checkout['account_type'] === 'new')
                <h3>New Account Information</h3>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" placeholder="Enter Name">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" placeholder="Enter Name">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Enter Email">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Enter password">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Confirm password</label>
                        <input type="password" class="form-control" placeholder="Enter confirmed password">
                    </div>
                </div>

            @endif

            <h3>Shipping Address</h3>
            <div class="col-md-6">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" placeholder="Enter Name">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Second Name</label>
                    <input type="text" class="form-control" placeholder="Enter Name">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>Address Line 1</label>
                    <input type="text" class="form-control" placeholder="Enter Name">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>Address Line 2</label>
                    <input type="text" class="form-control" placeholder="Enter Name">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Country</label>
                    <select class="form-control">
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
                    <select class="form-control">
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
                    <input type="text" class="form-control" placeholder="Enter Name">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Postal Code</label>
                    <input type="text" class="form-control" placeholder="Enter Name">
                </div>
            </div>

        </div>

        <div class="form-group">
            {!! Form::submit('Continue to payment', ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    {!! Form::close() !!}

</div>
@stop

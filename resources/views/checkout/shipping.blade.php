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

            @if ($account_type !== 'existing')
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('account_email', 'Email Address') !!}
                    {!! Form::text('account_email', $account_email, ['class' => 'form-control', 'placeholder' => 'Enter Email address']) !!}
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
                    <label>State/Province/Region</label>
                    <select name="state" class="form-control">
                        <option value="0">Select state</option>
                        <option value="1">California</option>
                        <option value="2">Florida</option>
                        <option value="3">New York</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Country</label>
                    <select name="country" class="form-control">
                        <option value="1">USA</option>
                        <option value="2">England</option>
                    </select>
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

    <?php echo '<pre>'; ?>
    {{ var_dump($checkout) }}
    <?php echo '</pre>'; ?>
</div>
@stop

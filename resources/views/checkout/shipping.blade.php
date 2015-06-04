@extends('checkout')
@section('content')
<h1>Shipping</h1>
<div class="panel-body">
    {!! Form::open(['route' => 'checkout.shipping']) !!}
        <div class="row">

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
            <label>Address Line 1</label>
            <input type="text" class="form-control" placeholder="Enter Name">
        </div>

        <div class="form-group">
            <label>Address Line 2</label>
            <input type="text" class="form-control" placeholder="Enter Name">
        </div>

        <div class="form-group">
            {!! Form::submit('Continue to payment', ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    {!! Form::close() !!}

</div>
@stop

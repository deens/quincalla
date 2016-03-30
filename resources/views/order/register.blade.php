@extends('app')
@section('content')
    <div class="container">

        @include('order.steps')

        <div class="row">

            <div class="col-md-8">
                <h1>Register</h1>

                {!! Form::open(['route' => 'order.register']) !!}
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('name', 'Full Name') !!}
                                {!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Your full name']) !!}
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('email', 'Email Address') !!}
                                {!! Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Enter Email address']) !!}
                            </div>
                        </div>

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

                        </div>
                    {!! Form::submit('Continue to Delivery', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>

            <div class="col-md-4">

            </div>
        </div>


    </div>
@stop


@extends('admin.layout')
@section('content')
{!! Form::open(['route' => 'admin.products.store', 'role' => 'form']) !!}
    <div class="row">
        <div class="col-md-5">
            <h1 class="page-header">Products \ <small> Add a product</small></h1>
        </div>
        <div class="col-md-7 text-right">
            <a href="{{ route('admin.products.index') }}" class="btn btn-default">Cancel</a>
            {!! Form::submit('Save product', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

    <hr>
        @include('admin.products.form')
    <hr>

    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('admin.products.index') }}" class="btn btn-default">Cancel</a>
            {!! Form::submit('Save product', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</form>
{!! Form::close() !!}
@stop



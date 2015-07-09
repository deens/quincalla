@extends('admin.layout')
@section('content')
    <h1 class="page-header">Customers</h1>

    <table class="table">
        <tr>
            <td></td>
            <td>Role</td>
            <td>Name</td>
            <td>Email</td>
            <td>Active</td>
        </tr>
        @foreach($customers as $customer)
        <tr>
            <td>{!! Form::checkbox('ids[]', $customer->id) !!}</td>
            <td>{{ $customer->role }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->active }}</td>
        </tr>
        @endforeach
    </table>

    <nav class="text-center">
        {!! $customers->render() !!}
    </nav>
@stop



@extends('admin.layout')
@section('content')
    <h1 class="page-header">Orders</h1>

    <table class="table">
        <tr>
            <td></td>
            <td>Customer</td>
            <td>Status</td>
            <td>Total amount</td>
            <td>Date</td>
        </tr>
        @foreach($orders as $order)
        <tr>
            <td>{!! Form::checkbox('ids[]', $order->id) !!}</td>
            <td>{{ $order->customer_name }} / {{ $order->customer_email }}</td>
            <td>{{ $order->status }}</td>
            <td>${{ number_format($order->total_amount, 2) }}</td>
            <td>{{ $order->created_at }}</td>
        </tr>
        @endforeach
    </table>

    <nav class="text-center">
        {!! $orders->render() !!}
    </nav>
@stop


@extends('admin.layouts.template')
@section('page_title', 'Confirmed Orders - Single Ecom')
@section('content')
<div class="container my-5">
    <h2 class="text-center">Confirmed Orders</h2>
    <div class="card">
        <table class="table">
            <tr>
                <th>User Id</th>
                <th>Shipping Information</th>
                <th>Product Id</th>
                <th>Quantity</th>
                <th>Total Paid</th>
            </tr>
            @foreach ($confirmed_orders as $order)
                <tr>
                    <td>{{ $order->user_id }}</td>
                    <td>
                        <ul>
                            <li>Phone Number - {{ $order->shipping_phoneNumber }}</li>
                            <li>City - {{ $order->shipping_city }}</li>
                            <li>Postal Code - {{ $order->shipping_postalcode }}</li>
                        </ul>
                    </td>
                    <td>{{ $order->product_id }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->total_price }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection

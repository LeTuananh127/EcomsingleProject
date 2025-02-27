@extends('admin.layouts.template')
@section('page_title')
Pending Orders - Single Ecom
@endsection
@section('content')
<div class="container my-5">
    <div class="card">
        <div class="card-title">
            <h2 class="text-center">Pending Orders</h2>
            <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>User Id</th>
                            <th>Shipping Information</th>
                            <th>Product Id</th>
                            <th>Quantity</th>
                            <th>Total Will Pay</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ( $pending_orders as $order)
                            <tr>
                                <td>
                                    {{ $order->user_id }}
                                </td>
                                <td>
                                    <ul>
                                        <li>Phone Number - {{ $order->shipping_phoneNumber }}</li>
                                        <li>City - {{ $order->shipping_city }}</li>
                                        <li>Postal Code - {{ $order->shipping_postalcode }}</li>
                                    </ul>
                                </td>
                                <td>
                                    {{ $order->product_id }}
                                </td>
                                <td>
                                    {{ $order->quantity }}
                                </td>
                                <td>
                                    {{ $order->total_price }}
                                </td>
                                <td>
                                    {{ $order->status }}
                                </td>
                                <td>
                                    <a href="{{ route('order.confirm', ['id' => $order->id]) }}" class="btn btn-success">Confirm</a>
                                    <a href="{{ route('order.cancel', ['id' => $order->id]) }}" class="btn btn-danger">Cancel</a>
                                </td>
                                
                                
                                
                            </tr>

                        @endforeach

                    </table>
            </div>
        </div>
    </div>
</div>
@endsection
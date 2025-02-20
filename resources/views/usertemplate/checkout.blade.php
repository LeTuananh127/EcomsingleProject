@extends('usertemplate.layouts.template')
@section('main-content')
<h2>Final Step To place Your Order</h2>

<div class="row">
    <div class="col-8">
        <div class="box_main">
            Product Will Send to this Address - 
            <p>City/Village - {{ $shipping_address->city_name }}</p>
            <p>Postal Code - {{ $shipping_address->postal_code }}</p>
            <p>Phone Number - {{ $shipping_address->phone_number }}</p>
        </div>
    </div>
    <div class="col-4">
        <div class="box_main">
            
            <div class="table-responsive">
                <h3>Your Final Products Are - </h3>
                <table class="table">
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ( $cart_items as $item)
                    <tr>
                        @php
                            $product_name = App\Models\Product::where('id', $item->product_id)->value('product_name');
                            $img = App\Models\Product::where('id', $item->product_id)->value('product_image');
                        @endphp
                        <td>{{ $product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }}</td>
                    </tr>
                    @php
                        $total += $item->price;
                    @endphp
                    
                    
                    @endforeach
                    @if ($total >0)
                    
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td>{{ $total }}</td>
                    </tr>
                    @endif
                </table>
                
            </div>

        </div>
    </div>
    <form action="{{ route('placeorder') }}" method="POST">
        @csrf
        <input type="submit" value="Place Order" class="btn btn-primary mr-3">
    </form>
    <form action="{{ route('placeorder')}}" method="POST">
        @csrf
        <input type="submit" value="CanCel Order" class="btn btn-danger">
    </form>
</div>    
@endsection
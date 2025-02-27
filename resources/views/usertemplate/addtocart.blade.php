@php
   $categories = App\Models\Category::latest()->get(); 
@endphp

@extends('usertemplate.layouts.template')
@section('main-content')
<h2>Add to Cart Page</h2>
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
<div class="row">
    <div class="col-12">
        <div class="box_main">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
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
                        <td><img src="{{ asset($img) }}" style="height:80px"></td>
                        <td>{{ $product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }}</td>
                        <td>
                            <a href="{{ route('removeitem', $item->id) }}" class="btn btn-danger">Remove</a>
                        </td>
                    </tr>
                    @php
                        $total += $item->price;
                    @endphp
                    
                    
                @endforeach
                @if ($total >0)
                    
                <tr>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td>{{ $total }}</td>
                    <td>
                        <a href="{{ route('shipingaddress')  }}" class="btn btn-primary">Checkout</a>
                    </td>
                </tr>
                @endif
                </table>
                
            </div>

        </div>
    </div>
</div>




@endsection
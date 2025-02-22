@extends('usertemplate.layouts.template')
@section('main-content')
<div class="fashion_section">
    <div class="container">
        <!-- Search Result Title -->
        <h1 class="fashion_taital py-5">
            Search Results for "{{ $query }}" - ({{ count($products) }})
        </h1>

        <!-- Price Filter -->

        <!-- Product List -->
        <div class="fashion_section_2">
            <div class="row">
                @forelse ($products as $product)
                    <div class="col-lg-4 col-sm-4">
                        <div class="box_main">
                            <h4 class="shirt_text">{{ $product->product_name }}</h4>
                            <p class="price_text">Price <span style="color: #262626;">${{ $product->price }}</span></p>
                            <div class="tshirt_img">
                                <img src="{{ asset($product->product_image) }}" alt="{{ $product->product_name }}">
                            </div>
                            <div class="btn_main">
                                <div class="buy-btn">
                                    <form action="{{ route('addproducttocart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                                        <input type="hidden" value="{{ $product->price }}" name="price">
                                        <input type="hidden" value="1" name="quantity">
                                        <br>
                                        <input type="submit" class="btn btn-primary" value="Buy Now">
                                    </form>
                                </div>
                                <div class="seemore_bt" style="margin-top:30px">
                                    <a href="{{ Route('singleproduct', [$product->id, $product->slug]) }}">See More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No products found matching "{{ $query }}" within the selected price range.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

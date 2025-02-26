@extends('usertemplate.layouts.template')
@section('main-content')
    <!-- fashion section start -->
    <div class="fashion_section">
        <div id="main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <h1 class="fashion_taital">All Products</h1>
                        <div class="fashion_section_2">
                            <div class="row">
                                @foreach ($allproducts as $product)
                                    <div class="col-lg-4 col-sm-4" >
                                        <div class="box_main">
                                            <h4 class="shirt_text">{{ $product->product_name }}</h4>
                                            <p class="price_text">Price <span style="color: #262626;">${{ $product->price }}</span></p>
                                            <div class="tshirt_img"><img src="{{ asset($product->product_image) }}" alt="{{ $product->product_name }}"></div>
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
                                                <div class="seemore_bt" style="margin-top:30px"><a  href="{{ Route('singleproduct',[$product->id, $product->slug]) }}">See More</a></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jewellery section end -->
@endsection
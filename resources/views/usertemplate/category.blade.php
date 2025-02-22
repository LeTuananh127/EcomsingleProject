@extends('usertemplate.layouts.template')
@section('main-content')
<div class="fashion_section">
    <div id="main_slider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <!-- Tiêu đề danh mục -->
                    <h1 class="fashion_taital py-5">
                        {{ $category->category_name }} - ({{ $category->product_count }})
                    </h1>

                    <!-- Bộ lọc giá -->
                    <form action="{{ route('category.filter', $category->id) }}" method="GET" class="mb-4">
                        <label for="price_range">Filter by Price:</label>
                        <select name="price_range" id="price_range" class="form-control" onchange="this.form.submit()">
                            <option value="">All</option>
                            <option value="0-50" {{ request('price_range') == '0-50' ? 'selected' : '' }}>$0 - $50</option>
                            <option value="50-100" {{ request('price_range') == '50-100' ? 'selected' : '' }}>$50 - $100</option>
                            <option value="100-200" {{ request('price_range') == '100-200' ? 'selected' : '' }}>$100 - $200</option>
                            <option value="200+" {{ request('price_range') == '200+' ? 'selected' : '' }}>Above $200</option>
                        </select>
                    </form>
                    

                    <!-- Danh sách sản phẩm -->
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
                                <p>No products found within the selected price range.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('admin.layouts.template')
@section('page_title')
Edit Product Image - Single Ecom
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages/</span> Edit Product Image</h4>
    <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit Product Image</h5>
            <small class="text-muted float-end">Input information</small>
          </div>
          <div class="card-body">
            <form action="{{ route('updateproductimg', ['id' => $productinfo->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $productinfo->id }}">
            
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Previous Image</label>
                    <div class="col-sm-10">
                        <img src="{{ asset($productinfo->product_image) }}" alt="Product Image" width="150">
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Upload New Product Image</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" name="product_img" />
                    </div>
                </div>
            
                <button type="submit" class="btn btn-primary">Update Image</button>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection
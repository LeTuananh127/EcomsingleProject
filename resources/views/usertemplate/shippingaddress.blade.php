@extends('usertemplate.layouts.template')
@section('main-content')
<h2>Provide Your Shipping Information</h2>
<div class="row">
    <div class="col-12">
        <div class="box_main">
            <form action="{{ route('addshipingaddress') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" name="phone_number" required>
                </div>

                <div class="form-group">
                    <label for="city_name">City/Village Name</label>
                    <input type="text" class="form-control" name="city_name" required>
                </div>

                <div class="form-group">
                    <label for="postal_code">Postal Code</label>
                    <input type="text" class="form-control" name="postal_code" required>
                </div>

                <input type="submit" value="Next" class="btn btn-primary">
            </form>
        </div>    
</div>
@endsection
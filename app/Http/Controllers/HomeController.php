<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function Index(){
        $allproducts = Product::latest()->get();
        return view('usertemplate.home',compact('allproducts'));
    }
}

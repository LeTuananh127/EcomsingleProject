<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function Index(){
        $products = Product::latest()->get();
        return view('admin.allproduct',compact('products'));
    }
    public function AddProduct(){
        $categories = Category::latest()->get();
        $subcategories = Subcategory::latest()->get();

        return view('admin.addproduct',compact('categories','subcategories'));
    }
    public function StoreProduct(Request $request){
        $request->validate([
            'product_name' => 'required|unique:products',
            'quantity' => 'required',
            'price' => 'required',
            'product_short_description' => 'required',
            'product_long_description' => 'required',
            'product_category_id' => 'required',
            'product_subcategory_id' => 'required',
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            
        ]);

        $image = $request->file('product_img');
        $img_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'), $img_name);
        $img_url = 'upload/'.$img_name;

        $category_id = $request->product_category_id;
        $subcategory_id = $request->product_subcategory_id;

        $category_name = Category::where('id', $category_id)->value('category_name');
        $subcategory_name = Subcategory::where('id', $subcategory_id)->value('subcategory_name');

        Product::insert([
            'product_name' => $request->product_name,
            'product_short_description' => $request->product_short_description,
            'product_long_description' => $request->product_long_description,
            'price' => $request->price,
            'product_category_id' => $category_id,
            'product_subcategory_id' => $subcategory_id,
            'product_category_name' => $category_name,
            'product_subcategory_name' => $subcategory_name,
            'product_image' => $img_url,
            'quantity' => $request->quantity,
            'slug' => strtolower(str_replace(' ', '-', $request->product_name)),
        ]);

        Category::where('id', $category_id)->increment('product_count', 1);
        Subcategory::where('id', $subcategory_id)->increment('product_count', 1);

        return redirect()->route('allproduct')->with('message', 'Product Added Successfully!');
    }
    public function EditProductImg($id){
        $productinfo = Product::findOrFail($id);
        return view('admin.editproductimg', compact('productinfo'));
    }
    public function UpdateProductImg(Request $request, $id) {  
     // Nhận $id từ route
        $request->validate([
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $product = Product::findOrFail($id);
    
        // Kiểm tra xem có file được upload không
        if ($request->hasFile('product_img')) {
            $image = $request->file('product_img');
            $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload'), $img_name);
            $img_url = 'upload/' . $img_name;
    
            // Cập nhật ảnh sản phẩm trong database
            $product = Product::findOrFail($id);
            $product->product_image = $img_url;
            $product->save();


        }
    
        return redirect()->route('allproduct')->with('message', 'Product Image Updated Successfully!');
    }
    public function EditProduct($id){
        $productinfo = Product::findOrFail($id);
        return view('admin.editproduct', compact('productinfo'));
    }
    public function UpdateProduct(Request $request){
        $request->validate([
            'product_name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'product_short_description' => 'required',
            'product_long_description' => 'required',
        ]);

        $productid = $request->id;

        Product::findOrFail($productid)->update([
            'product_name' => $request->product_name,
            'product_short_description' => $request->product_short_description,
            'product_long_description' => $request->product_long_description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'slug' => strtolower(str_replace(' ', '-', $request->product_name)),
        ]);



        return redirect()->route('allproduct')->with('message', 'Product Updated Successfully!');
    }

    public function DeleteProduct($id){
        $product = Product::findOrFail($id);
        $category_id = $product->product_category_id;
        $subcategory_id = $product->product_subcategory_id;

        $category_name = Category::where('id', $category_id)->value('category_name');
        $subcategory_name = Subcategory::where('id', $subcategory_id)->value('subcategory_name');

        Category::where('id', $category_id)->decrement('product_count', 1);
        Subcategory::where('id', $subcategory_id)->decrement('product_count', 1);

        $product->delete();
        return redirect()->route('allproduct')->with('message', 'Product Deleted Successfully!');
    }
    public function allProducts(Request $request) {
        $sort = $request->query('sort'); // Get sort parameter from URL
    
        if ($sort == 'asc') {
            $products = Product::orderBy('price', 'asc')->get();
        } elseif ($sort == 'desc') {
            $products = Product::orderBy('price', 'desc')->get();
        } else {
            $products = Product::all(); // Default
        }
    
        return view('admin.allproduct', compact('products'));
    }
    






    




}

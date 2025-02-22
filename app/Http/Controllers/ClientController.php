<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\ShippingInfo;
use App\Models\Order;




class ClientController extends Controller
{
    public function CategoryPage($id){
        $category = Category::findOrfail($id);
        $products = Product::where('product_category_id',$id)->latest()->get();
        return view('usertemplate.category',compact('category','products'));
    }
    public function SingleProduct($id){
        $product = Product::findOrfail($id);
        $subcat_id = Product::where('id',$id)->value('product_subcategory_id');
        $related_products = Product::where('product_subcategory_id',$subcat_id)->latest()->get();
        return view('usertemplate.product',compact('product','related_products'));
    }
    public function AddToCart(){
        $userid = Auth::id();
        $cart_items = Cart::where('user_id',$userid)->get();
        return view('usertemplate.addtocart',compact('cart_items'));
    }
    public function AddProductToCart(Request $request){
        $product_price = $request->price;
        $quantity = $request->quantity;
        $price = $product_price * $quantity;
        Cart::insert([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'quantity' => $request->quantity,
            'price' => $price,
        ]);

        return redirect()->route('addtocart')->with('message','Product added to cart successfully');
    }
    public function RemoveCartItem($id){
        Cart::where('id',$id)->delete();
        return redirect()->route('addtocart')->with('message','Product removed from cart successfully');
    }

    public function GetShippingAddress(){
        return view('usertemplate.shippingaddress');
    }

    public function AddShippingAddress(Request $request){
        $request->validate([
            'phone_number' => 'required',
            'city_name' => 'required',
            'postal_code' => 'required',
        ]);
        $userid = Auth::id();
        $shipping_info = [
            'user_id' => $userid,
            'phone_number' => $request->phone_number,
            'city_name' => $request->city_name,
            'postal_code' => $request->postal_code,
        ];
        ShippingInfo::insert($shipping_info);
        return redirect()->route('checkout')->with('message','Shipping address added successfully');
    }



    public function Checkout(){
        $userid = Auth::id();
        $cart_items = Cart::where('user_id',$userid)->get();
        $shipping_address = ShippingInfo::where('user_id',$userid)->first();
        return view('usertemplate.checkout',compact('cart_items','shipping_address'));
    }
    public function PlaceOrder(Request $request){
        $userid = Auth::id();
        $cart_items = Cart::where('user_id',$userid)->get();
        $shipping_address = ShippingInfo::where('user_id',$userid)->first();
        
    
        $total_price = 0;
        foreach($cart_items as $item){
            $total_price += $item->price;
        }
    
        $order = [
            'user_id' => $userid,
            'shipping_phoneNumber' => $shipping_address->phone_number,
            'shipping_city' => $shipping_address->city_name,
            'shipping_postalcode' => $shipping_address->postal_code,
            'product_id' => $item->product_id,
            'total_price' => $item->price,
            'quantity' => $item->quantity,
        ];
    
        Order::insert($order);
        $id = $item->id;
        Cart::findOrfail($id)->delete();

        ShippingInfo::where('user_id',$userid)->first()->delete();
    
        return redirect()->route('pendingorder')->with('message', 'Your Order Has Been Placed Successfully');
    }
    

    public function UserProfile(){
        return view('usertemplate.userprofile');
    }
    public function PendingOrder(){
        $pending_orders = Order::where('status','pending')->latest()->get();
        return view('usertemplate.pendingorders',compact('pending_orders'));
    }
    public function History(){
        return view('usertemplate.history');
    }
    public function NewRelease(){
        return view('usertemplate.newrelease');
    }
    public function Profile() {
        return redirect()->route('profile.edit');
    }
    

    public function TodaysDeal(){
        return view('usertemplate.todaysdeal');
    }
    public function CustomerService(){
        return view('usertemplate.customerservice');
    }
    public function filter(Request $request, $id)
    {
    $category = Category::findOrFail($id);
    $query = Product::where('product_category_id', $id);

    // Lọc sản phẩm theo mức giá
    if ($request->has('price_range')) {
        $priceRange = $request->input('price_range');

        switch ($priceRange) {
            case '0-50':
                $query->whereBetween('price', [0, 50]);
                break;
            case '50-100':
                $query->whereBetween('price', [50, 100]);
                break;
            case '100-200':
                $query->whereBetween('price', [100, 200]);
                break;
            case '200+':
                $query->where('price', '>', 200);
                break;
        }
    }

    $products = $query->get();
    $category->product_count = $products->count();

    return view('usertemplate.category', compact('category', 'products'));
    }


}

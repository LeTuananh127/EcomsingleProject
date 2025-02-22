<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SearchController;

Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'Index')->name('Home');

});
Route::controller(ClientController::class)->group(function(){
    
    Route::get('/category/{id}/filter','filter')->name('category.filter');
    Route::get('/category/{id}/{slug}', 'CategoryPage')->name('category');
    Route::get('/product-details/{id}/{slug}', 'SingleProduct')->name('singleproduct');
    Route::get('/new-release', 'NewRelease')->name('newrelease');

    


});

Route::middleware(['auth','role:user'])->group(function(){
    Route::controller(ClientController::class)->group(function(){
        Route::get('/add-to-cart', 'AddToCart')->name('addtocart');
        Route::post('/add-product-to-cart', 'AddProductToCart')->name('addproducttocart');
        Route::get('/checkout', 'Checkout')->name('checkout');
        Route::get('/shipping-address', 'GetShippingAddress')->name('shipingaddress');
        Route::post('/add-shipping-address', 'AddShippingAddress')->name('addshipingaddress');
        Route::post('/place-order', 'PlaceOrder')->name('placeorder');
        Route::get('/user-profile', 'UserProfile')->name('userprofile');
        Route::get('/user-profile/pending-order', 'PendingOrder')->name('pendingorder');
        Route::get('/user-profile/history', 'History')->name('history');
        Route::get('/todays-deal', 'TodaysDeal')->name('todaysdeal');
        Route::get('/custom-service', 'CustomerService')->name('customerservice');
        Route::get('/remove-cart-item/{id}', 'RemoveCartItem')->name('removeitem');
        Route::get('/your-profile', 'Profile')->name('profile');

        
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:user'])->name('dashboard');


Route::middleware(['auth','role:admin'])->group(function(){
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/admin/dashboard', 'Index')->name('admindashboard');
    });
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/admin/all-category', 'Index')->name('allcategory');
        Route::get('/admin/add-category', 'AddCategory')->name('addcategory');
        Route::post('/admin/add-category', 'StoreCategory')->name('storecategory');
        Route::get('/admin/edit-category/{id}', 'EditCategory')->name('editcategory');
        Route::post('/admin/update-category/{id}', 'UpdateCategory')->name('updatecategory');
        Route::get('/admin/delete-category/{id}', 'DeleteCategory')->name('deletecategory');

    });
    Route::controller(SubCategoryController::class)->group(function(){
        Route::get('/admin/all-subcategory', 'Index')->name('allsubcategory');
        Route::get('/admin/add-subcategory', 'AddSubCategory')->name('addsubcategory');
        Route::post('/admin/add-subcategory', 'StoreSubCategory')->name('storesubcategory');
        Route::get('/admin/edit-subcategory/{id}', 'EditSubCategory')->name('editsubcategory');
        Route::post('/admin/update-subcategory', 'UpdateSubCategory')->name('updatesubcategory');
        Route::get('/admin/delete-subcategory/{id}', 'DeleteSubCategory')->name('deletesubcategory');
    });
    Route::controller(ProductController::class)->group(function(){
        Route::get('/admin/all-product', 'Index')->name('allproduct');
        Route::get('/admin/add-product', 'AddProduct')->name('addproduct');
        Route::post('/admin/add-product', 'StoreProduct')->name('storeproduct');
        Route::get('/admin/edit-product-img/{id}', 'EditProductImg')->name('editproductimg');
        Route::post('/admin/update-product-img/{id}', [ProductController::class, 'UpdateProductImg'])->name('updateproductimg');
        Route::get('/admin/edit-product/{id}', 'EditProduct')->name('editproduct');
        Route::post('/admin/update-product', 'UpdateProduct')->name('updateproduct');
        Route::get('/admin/delete-product/{id}', 'DeleteProduct')->name('deleteproduct');


    });
    Route::controller(OrderController::class)->group(function(){
        Route::get('/admin/pending-order', 'Index')->name('pendingorders');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/search/filter', [ProductController::class, 'filter'])->name('search.filter');


require __DIR__.'/auth.php';

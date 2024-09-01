<?php

use Illuminate\Support\Facades\Route;
use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\{
    CustomerController,
    ProductController,
    OrderController,
    CategoryController,
    AdminController,
    HomeController,
};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [HomeController::class,'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/contact', function () {
    return view('home.contact');
})->name('contact');







Route::get('redirect', [HomeController::class,'redirect']);

Route::middleware(['auth', 'check_user_type:1'])->group(function () {
    Route::get('/order', [AdminController::class, 'order'])->name('order');
    Route::get('/service', [AdminController::class, 'service'])->name('admin.contact');
    Route::get('/update_product/{id}', [AdminController::class, 'update_product'])->name('admin.update_product');
    Route::post('update_product_confirm/{product}', [AdminController::class, 'update_product_confirm'])->name('update_product_confirm');
    Route::get('/view_category', [AdminController::class, 'view_category'])->name('admin.view_category');
    Route::get('/view_product', [AdminController::class, 'view_product'])->name('admin.view_product');
});

Route::get('product_details/{id}', [HomeController::class, 'product_details'])->name('product_details');
Route::post('add_cart/{id}', [HomeController::class, 'add_cart'])->name('add_cart');
Route::get('/show_cart', [HomeController::class, 'show_cart'])->name('show_cart');
Route::post('/cart/update/{id}', [HomeController::class, 'update_cart'])->name('cart.update');
Route::get('/cart/delete/{id}', [HomeController::class, 'delete_cart'])->name('cart.delete');
Route::get('/cash_order', [HomeController::class, 'cash_order'])->name('cash_order');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/category/{id}', [HomeController::class, 'showCategoryProducts'])->name('category.show');
Route::get('/stripe', [HomeController::class, 'stripe'])->name('stripe');
Route::post('stripe', [HomeController::class, 'stripePost'])->name('stripe.post');
Route::get('/delivered/{id}', [AdminController::class, 'delivered'])->name('delivered');
Route::delete('/delete_order/{id}', [AdminController::class, 'deleteOrder'])->name('delete_order');
Route::post('add_fav/{id}', [HomeController::class, 'add_fav'])->name('add_fav');
Route::get('/favorites', [HomeController::class, 'favorites'])->name('home.favorites');
Route::get('/remove_fav/{id}', [HomeController::class, 'removeFavorite'])->name('remove_fav');
Route::get('/my-orders', [HomeController::class, 'myOrders'])->name('home.myorders');
Route::get('/order-details/{id}', [HomeController::class, 'orderdetails'])->name('home.order-details');
Route::post('/order/cancel/{id}', [HomeController::class, 'cancelOrder'])->name('order.cancel');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::post('/contact/submit', [HomeController::class, 'submitContact'])->name('contact.submit');
Route::get('/product-list', [HomeController::class, 'productlistAjax']);
Route::get('product_details/{id}', [HomeController::class, 'product_details'])->name('home.product_details');





Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::middleware('auth')->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});
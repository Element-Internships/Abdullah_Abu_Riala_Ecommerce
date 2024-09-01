<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;

// Admin Routes
Route::prefix('admin')->middleware('auth', 'is_admin')->group(function() {
    Route::get('/category', [AdminController::class, 'view_category'])->name('admin.view_category');
    Route::get('/product', [AdminController::class, 'view_product'])->name('admin.view_product');
    Route::get('/update_product/{id}', [AdminController::class, 'update_product'])->name('admin.update_product');
    Route::post('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm'])->name('update_product_confirm');
    Route::get('/order', [AdminController::class, 'order'])->name('admin.order');
    Route::get('/delivered/{id}', [AdminController::class, 'delivered'])->name('admin.delivered');
    Route::get('/delete_order/{id}', [AdminController::class, 'deleteOrder'])->name('admin.delete_order');
    Route::get('/service', [AdminController::class, 'service'])->name('admin.service');
});

// Category Routes
Route::prefix('category')->middleware('auth', 'is_admin')->group(function() {
    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/update/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
});

// Home Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/redirect', [HomeController::class, 'redirect'])->name('home.redirect');
Route::get('/product_details/{id}', [HomeController::class, 'product_details'])->name('product_details');
Route::post('/add_cart/{id}', [HomeController::class, 'add_cart'])->name('add_cart');
Route::get('/show_cart', [HomeController::class, 'show_cart'])->name('show_cart');
Route::post('/cart/update/{id}', [HomeController::class, 'update_cart'])->name('cart.update');
Route::get('/cart/delete/{id}', [HomeController::class, 'delete_cart'])->name('cart.delete');
Route::get('/cash_order', [HomeController::class, 'cash_order'])->name('cash_order');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/show_category_products/{id}', [HomeController::class, 'showCategoryProducts'])->name('show_category_products');
Route::get('/stripe', [HomeController::class, 'stripe'])->name('stripe');
Route::post('/stripe', [HomeController::class, 'stripePost'])->name('stripe.post');
Route::post('/add_fav/{id}', [HomeController::class, 'add_fav'])->name('add_fav');
Route::get('/favorites', [HomeController::class, 'favorites'])->name('favorites');
Route::get('/remove_favorite/{id}', [HomeController::class, 'removeFavorite'])->name('remove_favorite');
Route::get('/myorders', [HomeController::class, 'myOrders'])->name('myOrders');
Route::get('/cancel_order/{id}', [HomeController::class, 'cancelOrder'])->name('cancelOrder');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/submit_contact', [HomeController::class, 'submitContact'])->name('submit_contact');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

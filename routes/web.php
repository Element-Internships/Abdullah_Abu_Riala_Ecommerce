<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/view_category', [AdminController::class, 'view_category'])->name('admin.view_category');
Route::get('/view_product', [AdminController::class, 'view_product'])->name('admin.view_product');
Route::get('/update_product/{id}', [AdminController::class, 'update_product'])->name('admin.update_product');
Route::post('update_product_confirm/{product}', [AdminController::class, 'update_product_confirm'])->name('update_product_confirm');
// Category creation form and store routes
Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
// Category edit form
Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

// Update category
Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

// Delete category
Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');


Route::middleware('auth')->group(function () {
    // Route to display the product creation form
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    // Route to handle form submission for creating a product
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    // Route to display a list of products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    
    // Route to handle product deletion
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});
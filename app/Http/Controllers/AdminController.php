<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function view_category()
    {
        $categories = Category::all(); 
        return view('admin.category', compact('categories'));
    }


    public function view_product()
    {
        $categories = Category::all(); // Retrieve all categories
        $products = Product::all(); // Retrieve all products
        return view('admin.product', compact('categories', 'products')); // Pass both categories and products to the view
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'stock_quantity' => 'required|integer',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $imagePath = $request->file('image') ? $request->file('image')->store('images/products', 'public') : null;

    Product::create(array_merge($request->all(), ['image_path' => $imagePath]));

    return redirect()->route('admin.view_product')->with('success', 'Product created successfully.');
}

public function edit(Product $product)
{
    $categories = Category::all();
    return view('admin.editproduct', compact('product', 'categories'));
}


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('images/products', 'public') : $product->image_path;

        $product->update(array_merge($request->all(), ['image_path' => $imagePath]));

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

  /**
     * Remove the specified category from storage.
     *
     * @param \App\Models\Product $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.view_product')->with('success', 'Product deleted successfully.');
    }
}

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
  

    // Method for editing a single product
    public function update_product($id)
    {

        $product=product::find($id);
        $categories = Category::all(); 
        return view('admin.update_product', compact('product','categories'));
        }


        public function update_product_confirm(Request $request, $id) {
            $product = Product::findOrFail($id);
        
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric',
                'stock_quantity' => 'required|integer',
                'category_id' => 'required|exists:categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);
        
            $imagePath = $request->file('image') ? $request->file('image')->store('images/products', 'public') : $product->image_path;
        
            $product->update(array_merge($request->except('image'), ['image_path' => $imagePath]));
        
            return redirect()->back();
        }
        


}

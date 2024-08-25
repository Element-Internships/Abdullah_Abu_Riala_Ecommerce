<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;

class HomeController extends Controller
{
     
    public function index() {
        $product = Product::all();
        $categories = Category::all(); 
        $latestProducts = Product::latest()->take(9)->get(); 
    
        $totalItems = 0;
        $totalPrice = 0;
        
        if (Auth::check()) {
            $user = Auth::user();
            $cartItems = Cart::where('user_id', $user->id)->get();
            $totalItems = $cartItems->sum('quantity');
            $totalPrice = $cartItems->sum('price');
        }
    
        return view('home.userpage', compact('product', 'categories', 'latestProducts', 'totalItems', 'totalPrice'));
    }
    
    public function redirect() {
        $usertype = Auth::user()->usertype;
    
        if ($usertype == '1') {
            return view('admin.home');
        } else {
            $product = Product::all();
            $categories = Category::all(); 
            $latestProducts = Product::latest()->take(9)->get(); 
    
            $totalItems = 0;
            $totalPrice = 0;
            
            $user = Auth::user();
            $cartItems = Cart::where('user_id', $user->id)->get();
            $totalItems = $cartItems->sum('quantity');
            $totalPrice = $cartItems->sum('price');
    
            return view('home.userpage', compact('product', 'categories', 'latestProducts', 'totalItems', 'totalPrice'));
        }
    }
   
    public function product_details(Request $request, $id) {
        $product = Product::findOrFail($id);
    
        $totalItems = 0;
        $totalPrice = 0;
    
        if (Auth::check()) {
            $user = Auth::user();
            $cartItems = Cart::where('user_id', $user->id)->get();
            $totalItems = $cartItems->sum('quantity');
            $totalPrice = $cartItems->sum('price');
        }
    
        return view('home.product_details', compact('product', 'totalItems', 'totalPrice'));
    }
    

    public function add_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $product = Product::find($id);
            $cart = new Cart;

            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;

            $cart->product_tittle = $product->name;
            $cart->price = $product->price;
            $cart->image = $product->image_path;
            $cart->Product_id = $product->id;

            $quantity = $request->input('quantity', 1); // Default to 1 if not provided
            $cart->quantity = $quantity;

            $cart->price = $product->price * $quantity;

            $cart->save();

            return redirect()->back()->with('message', 'Product added to cart successfully');
        } else {
            return redirect('login');
        }
    }

    public function show_cart()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $cartItems = Cart::where('user_id', $user->id)->get();
            $totalItems = $cartItems->sum('quantity');
            $totalPrice = $cartItems->sum('price');

            return view('home.showcart', compact('cartItems', 'totalItems', 'totalPrice'));
        } else {
            return redirect('login');
        }
    }

    public function update_cart(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $newQuantity = $request->input('quantity');
        $product = Product::findOrFail($cart->Product_id);
        $originalPrice = $product->price;

        $cart->quantity = $newQuantity;
        $cart->price = $originalPrice * $newQuantity;
        $cart->save();

        return redirect()->route('show_cart')->with('message', 'Cart updated successfully');
    }

    public function delete_cart($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('show_cart')->with('message', 'Product removed from cart');
    }
}

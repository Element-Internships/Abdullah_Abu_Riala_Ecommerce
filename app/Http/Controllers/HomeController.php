<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;

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
    \Log::info('Add to cart request received', $request->all());

    if (Auth::check()) {
        $user = Auth::user();
        $product = Product::find($id);

        if ($product) {
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
            $quantity = $request->input('quantity', 1);
            $cart->quantity = $quantity;
            $cart->price = $product->price * $quantity;
            $cart->save();

            $cartItems = Cart::where('user_id', $user->id)->get();
            $totalItems = $cartItems->sum('quantity');
            $totalPrice = $cartItems->sum('price');

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully',
                'totalItems' => $totalItems,
                'totalPrice' => $totalPrice
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Product not found']);
        }
    } else {
        return response()->json(['success' => false, 'message' => 'Please log in to add items to the cart']);
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


    public function cash_order()
    {
        $user = Auth::user();
        $userId = $user->id;
        $data = Cart::where('user_id', $userId)->get();
    
        foreach ($data as $item) {
            $order = new Order;
    
            $order->name = $item->name;
            $order->email = $item->email;
            $order->phone = $item->phone;
            $order->address = $item->address;
            $order->user_id = $item->User_id;
            $order->product_title = $item->product_tittle;
            $order->price = $item->price;
            $order->quantity = $item->quantity;
            $order->image = $item->image;
            $order->product_id = $item->product_id;
            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'Processing';
    
            $order->save();

            $cart = Cart::find($item->id);
            $cart->delete();
        }
    
        return redirect()->back()->with('message', 'Order placed successfully');
    }
    
}

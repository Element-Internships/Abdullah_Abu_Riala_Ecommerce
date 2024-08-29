<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Favorite;

use Stripe\Stripe;
use Stripe\Charge;
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
            $total_product=product::all()->count();
            $total_order=order::all()->count();
            $total_user=user::all()->count();
            return view('admin.home',compact('total_product','total_order','total_user'));
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

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully',
            'totalItems' => Cart::where('user_id', Auth::id())->sum('quantity'),
            'totalPrice' => Cart::where('user_id', Auth::id())->sum('price')
        ]);
    }

    return redirect()->route('show_cart')->with('message', 'Cart updated successfully');
}


public function delete_cart($id)
{
    $cart = Cart::findOrFail($id);
    $cart->delete();

    if (request()->ajax()) {
        return response()->json([
            'success' => true,
            'message' => 'Product removed from cart',
            'totalItems' => Cart::where('user_id', Auth::id())->sum('quantity'),
            'totalPrice' => Cart::where('user_id', Auth::id())->sum('price')
        ]);
    }

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

    public function shop()
    {
        $categories = Category::all();
        $products = Product::with('category')->paginate(9); // Fetch products with their categories and paginate
    
        return view('home.shop', compact('categories', 'products'));
    }
    

public function showCategoryProducts($id)
{
    $categories = Category::all(); // Assuming you have a Category model
    $category = Category::findOrFail($id);
    $products = $category->products; // Assuming the Product model has a relationship to Category

    return view('home.shop', compact('categories', 'products'));
}

    

public function stripe()
{
    if (Auth::check()) {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();
        $totalPrice = $cartItems->sum('price');

        return view('home.stripe', compact('totalPrice'));
    } else {
        return redirect('login');
    }
}


public function stripePost(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));

    try {
        Charge::create([
            "amount" => $request->amount * 100, // Convert amount to cents
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Payment for order."
        ]);

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
            $order->payment_status = 'Paid';
            $order->delivery_status = 'Processing';
    
            $order->save();

            $cart = Cart::find($item->id);
            $cart->delete();
        }

        Session::flash('success', 'Payment successful!');
    } catch (\Exception $e) {
        Session::flash('error', $e->getMessage());
    }

    return back();
}



// HomeController.php

public function add_fav(Request $request, $id)
{
    if (Auth::check()) {
        $userId = auth()->id(); // Get the currently logged-in user's ID
        $productId = $id;

        // Check if the product is already in the favorites
        $existingFav = Favorite::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($existingFav) {
            return response()->json(['success' => false, 'message' => 'Product is already in your favorites.']);
        }

        // Add to favorites
        Favorite::create([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        return response()->json(['success' => true, 'message' => 'Product added to your favorites.']);
    } else {
        return response()->json(['success' => false, 'message' => 'Please log in to add items to the favorites.']);
    }
}





}
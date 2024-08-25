<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;


class HomeController extends Controller
{
    

    public function index(){


        $product=Product::all();
        $categories = Category::all(); 
        $latestProducts = Product::latest()->take(9)->get(); 

        return view('home.userpage',compact('product','categories', 'latestProducts'));
    }

    public function redirect(){

        $usertype=Auth::user()->usertype;
        if($usertype=='1'){
            return view('admin.home');
        }

        else{
            $product=Product::all();
            $categories = Category::all(); 
            $latestProducts = Product::latest()->take(9)->get(); 
    
            return view('home.userpage',compact('product','categories', 'latestProducts'));
               }
    }


    public function product_details($id) {
        $product = Product::findOrFail($id);
        return view('home.product_details', compact('product'));
    }
    
    public function add_cart($id) {
       if(Auth::id()){
        return redirect()->back();
       }

       else{
        return redirect('login');
       }

    }

}

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
        return view('home.userpage',compact('product','categories'));
    }

    public function redirect(){

        $usertype=Auth::user()->usertype;
        if($usertype=='1'){
            return view('admin.home');
        }

        else{
            $product=Product::all();
        $categories = Category::all(); 
        return view('home.userpage',compact('product','categories')); 
               }
    }
}

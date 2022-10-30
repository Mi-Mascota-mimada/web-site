<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        $categories = Category::where('status','0')->get(); 
        return view('frontend.cart.index',compact('categories'));
    }
}

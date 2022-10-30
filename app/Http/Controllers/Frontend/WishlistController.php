<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishlistController extends Controller
{
    public function index()
    {       
        $categories = Category::where('status','0')->get(); 
        return view('frontend.wishlist.index', compact('categories'));
    }
}

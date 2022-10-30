<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', '0')->get();
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('frontend.orders.index', compact('categories', 'orders'));
    }

    public function show($orderId)
    {
        $categories = Category::where('status', '0')->get();
        $order = Order::where('user_id', Auth::user()->id)->where('id',$orderId)->first();
        if($order){
            return view('frontend.orders.view', compact('categories', 'order'));
        }else{
            return redirect()->back()->with('message', 'Pedido no encontrado');
        }
    }
}

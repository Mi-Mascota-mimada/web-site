<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\InvoiceOrderMailable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::when($request->date != null, function($q) use($request) {
                            return $q->whereDate('created_at', $request->date);
                        })
                        ->when($request->status != null, function($q) use($request) {
                            return $q->where('status_message', $request->status);
                        })
                        ->orderBy('created_at', 'DESC')
                        ->get();
        return view('admin.orders.index', compact('orders'));
    }
    public function details_orders(int $orderId)
    {
        $order = Order::where('id', $orderId)->first();
        if($order){
            $user = $this->user_exist($order->user_id);
            return view('admin.orders.view', compact('order','user'));
        }else{
            return redirect('admin/orders')->with('message', 'Order Id not found');
        }
        
    }

    public function user_exist(int $user_id)
    {
        $user = User::where('id', $user_id)->first();
        return $user ? $user : false;
    }

    public function updateOrderStatus(int $orderId, Request $request)
    {
        $user = $this->user_exist($request->user_id);
        $order = Order::where('id', $orderId)->first();
        if($order){
            $order->update([
                'status_message' => $request->order_status
            ]);  
            if($request->order_status == 'completed'){  
                $this->mailInvoice($orderId); 
                if($user){
                    $totalCoins = number_format(floatval($request->total) / 15000,'2','.');                                 
                    $user->increment('coins', $totalCoins);              
                }
            }    
            return redirect('admin/orders/'.$orderId)->with('message', 'Order Status Updated');
        }else{
            return redirect('admin/orders/'.$orderId)->with('message', 'Order Id not found');
        }
    }

    public function viewInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        $user = $this->user_exist($order->user_id);
        return view('admin.invoice.generate-invoice', compact('order','user'));
    }

    public function generateInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        $data = ['order' => $order];
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('factura'.$order->id.'-'.$order->fullname.'-'.$todayDate.'.pdf');
    }

    public function mailInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        try {
            Mail::to("$order->email")->send(new InvoiceOrderMailable($order));
        } catch (\Exception $e) {
            return redirect('admin/orders/'.$orderId)->with('message', 'Something went worng');
        }
        return redirect('admin/orders/'.$orderId)->with('message', 'Invoice Mail has been sent to '.$order->email);
    }
}

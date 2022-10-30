<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use Livewire\Component;
use App\Models\Orderitem;
use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CheckoutShow extends Component
{
    public $carts, $totalProductAmount = 0;

    public $fullname, $email, $phone, $pincode, $address, $payment_mode = NULL, $payment_id = NULL, $tracking, $totalPrice = 0, $method, $changeable = true;

    protected $listeners = [
        'validationForAll',
        'transactionEmit' => 'paidOnlineOrder'
    ];

    public function paidOnlineOrder($value)
    {
        $this->payment_id = $value;
        $this->tracking = 'PP-MMM-'.Str::random(10);
        $this->payment_mode = "Paid by Paypal";
        $this->makeOrder();
    }

    public function validationForAll()
    {
        $this->validate();
    }

    public function rules()
    {
        return [
            'fullname' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'phone' => 'required|string|max:15|min:8',
            'pincode' => 'string',
            'address' => 'required|string',
        ];
    }

    public function placeOrder()
    {         
        $user_id = Auth::check() === true ? auth()->user()->id : '0'; 
        $this->validate();
        $order = Order::create([
            'user_id' => $user_id,
            'tracking_no' => $this->tracking,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'pincode' => $this->pincode,
            'address' => $this->address,
            'status_message' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id
        ]);
        if(Auth::check()){
            foreach ($this->carts as $cartItem) {
                $this->totalPrice += $cartItem->product->selling_price * $cartItem->quantity; 
                $orderItems = Orderitem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product_color_id' => $cartItem->product_color_id,
                    'quantity'=> $cartItem->quantity,
                    'price' => $cartItem->product->selling_price
                ]);
    
                if($cartItem->product_color_id != NULL){
                    $cartItem->productColor()->where('id', $cartItem->product_color_id)->decrement('quantity',$cartItem->quantity);
                }else{
                    $cartItem->product()->where('id', $cartItem->product_id)->decrement('quantity',$cartItem->quantity);
                }
            }
        }else{
            foreach ($this->carts as $cartItem) {
                $this->totalPrice += $cartItem['price'] * $cartItem['quantity']; 
                $color = isset($cartItem['attributes']['productColorId']) ? $cartItem['attributes']['productColorId'] : NULL;
                $orderItems = Orderitem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem['id'],
                    'product_color_id' => $color,
                    'quantity'=> $cartItem['quantity'],
                    'price' => $cartItem['price']
                ]);
    
                if($color != NULL){
                    ProductColor::where('id', $cartItem['attributes']['productColorId'])->decrement('quantity',$cartItem['quantity']);
                }else{
                    Product::where('id', $cartItem['id'])->decrement('quantity',$cartItem['quantity']);
                }
            }
        }
        return $order;       
    }

    public function codOrder()
    {
        $this->payment_mode = 'Cash on Delivery';
        $this->tracking = 'CE-MMM-'.Str::random(10);
        $this->makeOrder();
    }

    public function coinsOrder()
    {
        $this->payment_mode = 'Coins exchange';
        $this->tracking = 'MC-MMM-'.Str::random(10);
        $this->method = 'exchange';
        $this->makeOrder();
    }

    public function makeOrder()
    {
        $codOrder = $this->placeOrder();
        if($codOrder){
            if(Auth::check()){
                Cart::where('user_id', auth()->user()->id)->delete();
            }else{
                \Cart::clear();
            }

            $this->dispatchBrowserEvent('message', [
                'text' => "Compra realizada con exito",
                'type' => 'success'
            ]);
            if($this->method == "exchange"){                
                $user = User::where('id', auth()->user()->id)->first();        
                $user->decrement('coins', $this->totalPrice/1000);
            }
            return redirect('/thank-you')->with('message', $this->tracking );
        }else{
            $this->dispatchBrowserEvent('message', [
                'text' => "Ha ocurrido un error",
                'type' => 'error'
            ]);
        }
    }

    public function totalProductAmount()
    {
        $this->totalProductAmount = 0;
        if(Auth::check()){
            $this->carts = Cart::where('user_id', auth()->user()->id)->get();
            foreach ($this->carts as $cartItem) {
                $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
            }
        }else{
            $this->carts = \Cart::getContent();
            $this->totalProductAmount = \Cart::getTotal();
        }
        
        return $this->totalProductAmount;
    }

    public function productChangeable()
    {
        $this->carts= Cart::where('user_id', auth()->user()->id)->get();
        foreach ($this->carts as $cartItem) {
            if($cartItem->product->changeable == '0' )
                $this->changeable = false;
        }
        return $this->changeable;
    }

    public function render()
    {
        $this->fullname = Auth::check() === true ? auth()->user()->name : '' ;
        $this->email = Auth::check() === true ? auth()->user()->email : '';
        $this->totalProductAmount = $this->totalProductAmount();
        $this->changeable = Auth::check() === true ? $this->productChangeable() : '0';
        return view('livewire.frontend.checkout.checkout-show', [
            'totalProductAmount' => $this->totalProductAmount,
            'changeable' => $this->changeable
        ]);
    }
}

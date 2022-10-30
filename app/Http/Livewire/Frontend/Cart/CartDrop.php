<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartDrop extends Component
{
    public $cart;

    protected $listeners = ['CartShowingDrop' => 'render'];
    
    public function render()
    {
        if(Auth::check()){
            $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        }else{
            $this->cart = \Cart::getContent();
        }
        return view('livewire.frontend.cart.cart-drop',[
            'cart' => $this->cart
        ]);
    }
}

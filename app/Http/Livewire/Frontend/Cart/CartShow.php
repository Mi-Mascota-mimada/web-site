<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartShow extends Component
{
    public $cart, $totalPrice = 0;
    
    public function changeQuantity(int $cartId, $val, int $cartQuantity)
    {
        if(Auth::check()){
            $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
            if($cartData){           
                if($cartData->productColor()->where('id', $cartData->product_color_id)->exists()){
                    $productColor = $cartData->productColor()->where('id', $cartData->product_color_id)->first();
                    if($val == "decrement" && $cartData->quantity > 1){
                        $cartData->decrement('quantity');
                    }elseif($val == "increment"){                    
                        if($productColor->quantity > $cartData->quantity){     
                            $cartData->increment('quantity');  
                        }else{
                            $this->dispatchBrowserEvent('message', [
                                'text' => "Solo hay $productColor->quantity unidades disponibles",
                                'type' => 'error'
                            ]);
                        }
                    } 
                    
                }else{
                    if($val == "decrement" && $cartData->quantity > 1){
                        $cartData->decrement('quantity');
                    }elseif($val == "increment"){                    
                        if($cartData->product->quantity > $cartData->quantity){  
                            $cartData->increment('quantity'); 
                        }else{
                            $this->dispatchBrowserEvent('message', [
                                'text' => "Solo hay {$cartData->product->quantity} unidades disponibles",
                                'type' => 'error'
                            ]);
                        }
                    } 
                    
                }
                
            }else{
                $this->dispatchBrowserEvent('message', [
                    'text' => "Ocurrio algo",
                    'type' => 'error'
                ]);
            }
        }else{
            if($val == 'increment'){
                $cartQuantity++;
            }else{
                if($cartQuantity > 1){
                    $cartQuantity--;
                }else{
                    $this->dispatchBrowserEvent('message', [
                        'text' => "La cantidad minima es 1 producto",
                        'type' => 'error'
                    ]);
                }
            }
            \Cart::update($cartId,
                array(
                    'quantity' => array(
                        'relative' => false,
                        'value' =>  $cartQuantity
                    ),
                )
            );
            $this->emit('CartShowingDrop');
            $this->emit('CartAddedUpdated');
        }
       
    }
    
    public function removeCartItem(int $cartId)
    {
        if (Auth::check()) {
            $cartRemoveData = Cart::where('user_id', auth()->user()->id)->where('id', $cartId)->first();
            if($cartRemoveData){
                    $cartRemoveData->delete();
                    $this->emit('CartShowingDrop');
                    $this->emit('CartAddedUpdated');
                    $this->dispatchBrowserEvent('message', [
                        'text' => "producto eliminado del carrito",
                        'type' => 'success'
                    ]);
            }else{
                    $this->dispatchBrowserEvent('message', [
                        'text' => "El producto no existe",
                        'type' => 'error'
                    ]);
            }
        } else {
            \Cart::remove($cartId);
            $this->emit('CartShowingDrop');
            $this->emit('CartAddedUpdated');
            $this->dispatchBrowserEvent('message', [
                'text' => "producto eliminado del carrito",
                'type' => 'success'
            ]);
        }
        
       
    }

    public function render()
    {   
        if(Auth::check()){
            $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        }else{
            $this->cart = \Cart::getContent();
        }
        return view('livewire.frontend.cart.cart-show',[
            'cart' => $this->cart
        ]);
    }
}

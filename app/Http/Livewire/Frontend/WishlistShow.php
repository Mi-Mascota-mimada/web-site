<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistShow extends Component
{

    public function removeWishlistItem(int $wishlistId)
    {
        if(Auth::check()){
            Wishlist::where('id', $wishlistId)->where('user_id',auth()->user()->id)->delete();
        }else{
            $wish_list = app('wishlist');
            $wish_list->remove($wishlistId);
        }
        $this->emit('wishlistAddedUpdated');  
        $this->dispatchBrowserEvent('message', [
            'text' => 'Producto eliminado con exito',
            'type' => 'success'
        ]);  
    }

    public function render()
    {
        if(Auth::user()){
            $user_id = auth()->user()->id;
            $wishlist = Wishlist::where('user_id', $user_id )->get();
        }else{
            $wishlist = [];
            $wish_list = app('wishlist');
            $wish_list->getContent()->each(function($item) use (&$wishlist){
                $wishlist[] = $item;
            });
        }
        return view('livewire.frontend.wishlist-show',[
            'wishlist' => $wishlist
        ]);
    }
}

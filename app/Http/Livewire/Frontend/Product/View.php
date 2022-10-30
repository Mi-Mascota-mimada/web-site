<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\Wishlist;
use App\Models\RateProduct;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $category, $product, $prodColorSelectedQuantity, $myRate, $quantityCount = 1, $productColorId, $relationsProducts;

    public function addToWishList($productId)
    {
        if(Auth::check()){
            if(Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()){
                $this->dispatchBrowserEvent('message', [
                    'text' => 'El producto ya existe en la lista de deseos',
                    'type' => 'warning'
                ]);
                return false;
            }else{
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                $this->emit('wishlistAddedUpdated');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Producto agregado a la lista de deseos',
                    'type' => 'success'
                ]);
            }
            
        }else{ 
            $productToAdd = Product::where('id', $productId)->get();               
            $wish_list = app('wishlist');
            $wish_list->add(
                            strval($productId),
                            $productToAdd[0]->name,
                            floatval($productToAdd[0]->selling_price),
                            1,
                            array(
                                'image' => $productToAdd[0]->productImages[0]->image,
                                'slug' => $productToAdd[0]->slug,
                                'category_slug' => $productToAdd[0]->category->slug
                            ));
            $this->emit('wishlistAddedUpdated');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Producto agregado a la lista de deseos',
                'type' => 'success'
            ]);
        }
    }

    public function rateProduct($productId)
    {
        $this->myRate < 3 ? $this->myRate = 3 : $this->myRate;
        if(Auth::check()){
            if(RateProduct::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()){ 
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Ya calificaste este producto',
                    'type' => 'error'
                ]);
                return false;
            }else{
                RateProduct::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId,
                    'rate' => $this->myRate
                ]);
                $sumRate = RateProduct::where('product_id',$productId)->sum('rate');
                $numRate = RateProduct::where('product_id',$productId)->count('id');
                $totalRate = $sumRate / $numRate;     
                Product::where('id',$productId)->update(['qualification' => intval(ceil($totalRate))]);
                $this->dispatchBrowserEvent('message', [
                    'text' => '¡¡Gracias!!',
                    'type' => 'success'
                ]);
            }
            
        }else{
            $this->dispatchBrowserEvent('message', [
                'text' => 'Por favor inicia sesion para continuar',
                'type' => 'info'
            ]); 
            return false;
        }
    }

    public function colorSelected($productColorId)
    {
        $this->productColorId = $productColorId;
        $productColor = $this->product->productColors()->where('id', $productColorId)->first();
        $this->prodColorSelectedQuantity = $productColor->quantity;

        if ($this->prodColorSelectedQuantity == 0) {
            $this->prodColorSelectedQuantity = "Agotado";
        }
    }

    public function decrementQuantity()
    {
        if($this->quantityCount > 1) $this->quantityCount--;
    }
    public function incrementQuantity()
    {
        $this->quantityCount++;
    }

    public function addToCart(int $productId)
    {
        if(Auth::check()){
            
            if ($this->product->where('id', $productId)->where('status', '0')->exists()) {
                //check for product color quantity                
                if ($this->product->productColors()->count() > 1) {                   
                    if($this->prodColorSelectedQuantity !== null){    
                        $productColor = $this->product->productColors()->where('id',$this->productColorId)->first(); 
                        if(Cart::where('user_id',auth()->user()->id)->where('product_id', $productId)->where('product_color_id', $this->productColorId)->exists()){
                            $productSelectedQuantity = Cart::where('product_color_id',$this->productColorId)->value('quantity');
                            $totalQuantityColor = intval($this->quantityCount) + intval($productSelectedQuantity);
                            if($totalQuantityColor <= $productColor->quantity){
                                Cart::where('product_color_id',$this->productColorId)->update([
                                    'quantity' => $totalQuantityColor
                                ]);
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Producto añadido al carrito',
                                    'type' => 'success'
                                ]);
                            }else{
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'La cantidad añadida al carrito sobre pasa las unidades disponibles',
                                    'type' => 'warning'
                                ]);
                            }                            
                        }else{                                                   
                            if($productColor->quantity > 0){
                                if ($this->quantityCount <= $productColor->quantity) {
                                    Cart::create([
                                        'user_id' => auth()->user()->id,
                                        'product_id' => $productId,
                                        'product_color_id' => $this->productColorId,
                                        'quantity' => $this->quantityCount
                                    ]);
                                    $this->emit('CartAddedUpdated');                                    
                                    $this->emit('CartShowingDrop');
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => "Producto añadido al carrito",
                                        'type' => 'success'
                                    ]);
                                } else {
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => "solo existen {$productColor->quantity} unidades del color {$productColor->color->name}",
                                        'type' => 'error'
                                    ]);
                                }
                            }else{
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'El color de este producto estass agotado',
                                    'type' => 'error'
                                ]);
                            }
                        } 
                    }else{
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Por favor seleccione el color del producto',
                            'type' => 'error'
                        ]);
                    }
                } else {
                    if(Cart::where('user_id',auth()->user()->id)->where('product_id', $productId)->exists()){
                        $productSelectedQuantity = Cart::where('product_id',$productId)->value('quantity');
                        $totalQuantity = intval($this->quantityCount) + intval($productSelectedQuantity);
                        if($totalQuantity <= $this->product->quantity){
                            Cart::where('product_id',$productId)->update([
                                'quantity' => $totalQuantity
                            ]);
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Producto añadido al carrito',
                                'type' => 'success'
                            ]);
                        }else{
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'La cantidad añadida al carrito sobre pasa las unidades disponibles',
                                'type' => 'warning'
                            ]);
                        }        
                    }else{
                        if($this->product->quantity > 0){
                            if ($this->quantityCount <= $this->product->quantity) {
                                Cart::create([
                                    'user_id' => auth()->user()->id,
                                    'product_id' => $productId,
                                    'quantity' => $this->quantityCount
                                ]);
                                $this->emit('CartShowingDrop');
                                $this->emit('CartAddedUpdated');
                                $this->dispatchBrowserEvent('message', [
                                    'text' => "Producto añadido al carrito",
                                    'type' => 'success'
                                ]);
                            } else {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => "solo existen {$this->product->quantity} unidades disponibles",
                                    'type' => 'error'
                                ]);
                            }
                            
                        }else{
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'El producto esta agotado',
                                'type' => 'error'
                            ]);
                        }
                    }
                }               
            }else{
                $this->dispatchBrowserEvent('message', [
                    'text' => 'El producto no existe',
                    'type' => 'info'
                ]);
            }
        }else{
            // si no tiene usuario
            $productToAdd = $this->product->where('id', $productId)->where('status', '0')->first();
            if($productToAdd->productColors()->count() > 0){
                $productSessionColor = $this->product->productColors()->where('id', $this->productColorId)->first();
                if($this->prodColorSelectedQuantity){
                    \Cart::add(array(
                        'id' => $productId,
                        'name' => $productToAdd->name,
                        'price' => $productToAdd->selling_price,
                        'quantity' => $this->quantityCount,
                        'attributes' => array(
                            'image' => $productToAdd->productImages[0]->image,
                            'slug' => $productToAdd->slug,
                            'changeable' => $productToAdd->changeable,
                            'productColor' => $productSessionColor->color->name,
                            'productColorId' => $productSessionColor->color->id,
                            'productCategory' => $productToAdd->category->slug
                        )
                    ));
                    $this->emit('CartShowingDrop');
                    $this->emit('CartAddedUpdated');
                    $this->dispatchBrowserEvent('message', [
                        'text' => "Producto añadido al carrito",
                        'type' => 'success'
                    ]);
                }else{
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Por favor seleccione el color del producto',
                        'type' => 'error'
                    ]);
                }
            }else{
                \Cart::add(array(
                    'id' => $productId,
                    'name' => $productToAdd->name,
                    'price' => $productToAdd->selling_price,
                    'quantity' => $this->quantityCount,
                    'attributes' => array(
                        'image' => $productToAdd->productImages[0]->image,
                        'slug' => $productToAdd->slug,
                        'changeable' => $productToAdd->changeable,
                        'productCategory' => $productToAdd->category->slug
                    )
                ));
                $this->emit('CartShowingDrop');
                $this->emit('CartAddedUpdated');
                $this->dispatchBrowserEvent('message', [
                    'text' => "Producto añadido al carrito",
                    'type' => 'success'
                ]);
            }                    
            
        }
    }

    public function mount($category, $product, $relationsProducts)
    {
        $this->product = $product;
        $this->category = $category;  
        $this->relationsProducts = $relationsProducts;  
    }

    public function render()
    {
        return view('livewire.frontend.product.view',[
            'category' => $this->category,
            'product' => $this->product,
            'relationsProducts' => $this->relationsProducts
        ]);
    }
}

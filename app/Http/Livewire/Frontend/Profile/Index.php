<?php

namespace App\Http\Livewire\Frontend\Profile;

use App\Models\User;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;
    public $categories, $user, $user_id, $name, $email, $picture, $pictureBack;

    public function editProfile(int $user_id)
    {   
        $this->user_id = $user_id;
        $user = User::findOrFail($user_id);
        $this->name = $user->name;    
        $this->email = $user->email; 
        $this->picture = $user->picture;     
        $this->pictureBack = $this->picture;    
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.auth()->user()->id.',id',
            'picture' => 'nullable'
        ];
    }

    public function resetInput()
    {
        $this->name = NULL;
        $this->email = NULL;
        $this->picture = NULL;
        $this->pictureBack = NULL;
        $this->user_id = NULL;
    }

    public function closeModal()
    {
        $this->resetInput();
    }
    public function updateMyProfile()
    {
        $validatedData = $this->validate(); 
        if($this->pictureBack !== $this->picture){
           $url = $this->picture->store('profile','public'); 
           if(Storage::exists('public/'.$this->pictureBack)){
                Storage::delete('public/'.$this->pictureBack);
            }
        }        
        User::findOrFail($this->user_id)->update([
            'name' => $this->name,
            'email' => $this->email,
            'picture' => isset($url) ? $url : $this->picture
        ]);
        session()->flash('message', 'Brand Deleted Successfully');
        $this->dispatchBrowserEvent('close-profile-modal');
        $this->resetInput();
    }

    public function render()
    {
        $this->categories = Category::where('status', '0')->get();
        $this->user = User::where('id', Auth::user()->id)->first();
        $totalCoins = floatVal(Auth::user()->coins * 1000);
        if(Auth::user()->coins > 99){
            $mimadoProducts = Product::where('status', '0')->where('selling_price','<',$totalCoins)->where('changeable', '1')->where('quantity','>','0' )->get();
        }else{
            $mimadoProducts = [];
        }        
        return view('livewire.frontend.profile.index', [
            'categories' => $this->categories,
            'user' => $this->user,
            'mimadoProducts' => $mimadoProducts
        ]);
    }
}

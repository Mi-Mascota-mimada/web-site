<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', '0')->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('frontend.profile.index', compact('categories', 'user'));
    }

    public function passwordCreate()
    {
        $categories = Category::where('status', '0')->get();
        return view('frontend.profile.change-password', compact('categories'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required','string','min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('message','Contraseña actualizada satisfactoriamente');

        }else{

            return redirect()->back()->with('message','Las contraseñas no coinciden');
        }
    }
}

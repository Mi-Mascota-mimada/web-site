<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Messages;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status','0')->get();
        $brands = Brand::where('status','0')->take(4)->get();
        $products = Product::where('status','0')->where('category_id','!=',6)->where('category_id','!=',5)->get();
        $categories = Category::where('status','0')->get();
        $accesoriesToys = Product::where('status','0')->where('category_id',6)->orWhere('category_id',5)->get();
        return view('frontend.index', compact('sliders','brands','products','categories','accesoriesToys'));
    }

    public function new_products()
    {
        $categories = Category::where('status','0')->get();
        $trendingProducts = Product::where('status', '0')->where('trending','1')->latest()->take(15)->get();
        return view('frontend.main.newProducts', compact('categories', 'trendingProducts'));
    }

    public function sales()
    {
        $categories = Category::where('status','0')->get();
        $salesProducts = Product::where('status', '0')->where('original_price','!=','0')->get();
        return view('frontend.main.sales', compact('categories', 'salesProducts'));
    }

    public function contact()
    {
        $categories = Category::where('status', '0')->get();
        return view('frontend.contact', compact('categories'));
    }

    public function message(Request $request)
    {       
        Messages::create([
            'name' => htmlspecialchars($request->name, ENT_QUOTES),
            'email' => htmlspecialchars($request->email, ENT_QUOTES),
            'cel' => htmlspecialchars($request->cel, ENT_QUOTES),
            'message' => htmlspecialchars($request->message, ENT_QUOTES)
        ]);
        return redirect('/contact')->with('message', 'El mensaje ha sido enviado');
    }

    public function categories()
    {
        $categories = Category::where('status', '0')->get();
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function products($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        $categories = Category::where('status', '0')->get();
        if($category){            
            return view('frontend.collections.products.index', compact('category', 'categories'));
        }else{
            return redirect()->back();
        }
    }

    public function productView(string $category_slug, string $product_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        $categories = Category::where('status', '0')->get();        
        if($category){           
            $product = $category->products()->where('slug',$product_slug)->where('status','0')->first();
            $relationsProducts = $category->products()->where('category_id', $product->category_id)->where('id', '!=', $product->id)->take(4)->get();
            
            if($product){
                return view('frontend.collections.products.view', compact('product','category', 'categories','relationsProducts'));
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }
    public function search(Request $request){   
        $name = $request->name;
        $products = Product::where('status', '0')->where('name','LIKE',"%{$name}%")->get();
        $categories = Category::where('status', '0')->get();
        
        return view('frontend.search', compact('products', 'categories'));
    }
    
    public function thankyou()
    {
        $categories = Category::where('status', '0')->get();        
        return view('frontend.thank-you', compact('categories'));
    }

    public function discount_info()
    {
        $shopping = "";
        if(Auth::check()){            
            $shopping = Order::where('user_id', '=', auth()->user()->id)->get()->count();            
        }
        $categories = Category::where('status', '0')->get();        
        return view('frontend.discount_info', compact('categories','shopping'));
    }

    public function cookies()
    {
        $categories = Category::where('status', '0')->get();        
        return view('frontend.cookies.aviso_cookies', compact('categories'));
    }
}

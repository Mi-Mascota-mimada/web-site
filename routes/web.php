<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// GOOGLE AUTH SOCIALITE
Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();
    $userExists = User::where('external_id', $user->id)->where('external_auth', 'google')->first();
    $userAlreadyExists = User::where('email', $user->email)->first();
    if($userExists){
        Auth::login($userExists);
    }elseif($userAlreadyExists){
        Auth::login($userAlreadyExists);
    }else{
        $userNew = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'picture' => $user->avatar_original,
            'external_id' => $user->id,
            'external_auth' => 'google',
        ]);
        Auth::login($userNew);
    }
    return redirect('/admin/dashboard');
});

//AUTH
Auth::routes();
// HOME
Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index']);
//new products
Route::get('/new-products', [App\Http\Controllers\Frontend\FrontendController::class, 'new_products']);
//sales
Route::get('/sales', [App\Http\Controllers\Frontend\FrontendController::class, 'sales']);
// Contact
Route::get('/contact', [App\Http\Controllers\Frontend\FrontendController::class, 'contact']);
Route::post('/contact', [App\Http\Controllers\Frontend\FrontendController::class, 'message']);
// Categories
Route::get('/collections', [App\Http\Controllers\Frontend\FrontendController::class, 'categories']);
// Slugs
Route::get('/collections/{category_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'products']);
// Single product
Route::get('/collections/{category_slug}/{product_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'productView']);
// Search
Route::get('search', [App\Http\Controllers\Frontend\FrontendController::class, 'search']);
//Aviso cookies
Route::get('aviso-cookies', [App\Http\Controllers\Frontend\FrontendController::class, 'cookies']);

//Wishlist
Route::get('wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'index']);

//Cart
Route::get('cart', [App\Http\Controllers\Frontend\CartController::class, 'index']);

//Check out
Route::get('checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index']);

//Orders
Route::get('orders', [App\Http\Controllers\Frontend\OrderController::class, 'index'])->middleware(['auth'])->name('orders');
Route::get('orders/{orderId}', [App\Http\Controllers\Frontend\OrderController::class, 'show'])->middleware(['auth'])->name('orders');

//Thank You
Route::get('thank-you', [App\Http\Controllers\Frontend\FrontendController::class, 'thankyou']);

//Discount info
Route::get('discount_info', [App\Http\Controllers\Frontend\FrontendController::class, 'discount_info']);

//Profile
Route::get('profile', [App\Http\Controllers\Frontend\ProfileController::class, 'index'])->middleware(['auth'])->name('profile');
//Change the password
Route::get('change-password', [App\Http\Controllers\Frontend\ProfileController::class, 'passwordCreate'])->middleware(['auth'])->name('change-password');
Route::post('change-password', [App\Http\Controllers\Frontend\ProfileController::class, 'changePassword'])->middleware(['auth'])->name('change-password');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// ADMIN
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function (){

    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    // Settings
    Route::controller(App\Http\Controllers\Admin\SettingController::class)->group(function (){
        Route::get('settings', 'index');
        Route::post('settings', 'store');
    });

    // Users
    Route::controller(App\Http\Controllers\Admin\UsersController::class)->group(function () {
        Route::get('/users','index');
        Route::get('/users/add_user', 'create');    
        Route::post('/users', 'store');  
        Route::post('/users/{userId}', 'changeRole'); 
    });

    // Orders
    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function () {
        Route::get('/orders','index');
        Route::get('/orders/{orderId}','details_orders');
        Route::put('/orders/{orderId}','updateOrderStatus');

        //PDF
        Route::get('/invoice/{orderId}','viewInvoice');
        Route::get('/invoice/{orderId}/generate','generateInvoice');
        //SEND MAIL
        Route::get('/invoice/{orderId}/mail','mailInvoice');
    });


    // Sliders
    Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function () {
            Route::get('sliders', 'index');
            Route::get('sliders/addSlider', 'create');
            Route::post('sliders/create', 'store');
            Route::get('sliders/{slider}/edit', 'edit');
            Route::put('sliders/{slider}', 'update');
            Route::get('sliders/{slider}/delete', 'destroy');
    });

    // Category Route
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{category}/edit', 'edit');
        Route::put('/category/{category}', 'update');
    });

    // Products Route
    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::get('/products','index');
        Route::get('/products/add_product', 'create');
        Route::post('/products', 'store');
        Route::get('/products/{product}/edit', 'edit');
        Route::put('/products/{product}', 'update');
        Route::get('/products/{product_id}/delete', 'destroy');
        Route::get('/product-image/{product_image_id}/delete', 'destroyImage');

        Route::post('/product-color/{prod_color_id}', 'updateProdColorQty');
        Route::get('/product-color/{prod_color_id}/delete', 'deleteProdColor');
    });

    // Brands
    Route::get('/brands', App\Http\Livewire\Admin\Brand\Index::class);
    
    //Colors
    Route::controller(App\Http\Controllers\Admin\ColorController::class)->group(function () {
        Route::get('/colors','index');
        Route::get('/colors/addColor', 'create');
        Route::post('/colors/create', 'store');
        Route::get('/colors/{color}/edit', 'edit');
        Route::put('/colors/{color_id}', 'update');
        Route::get('/colors/{color_id}/delete', 'destroy');
    });

    //Messages
    Route::controller(App\Http\Controllers\Admin\MessagesController::class)->group(function (){
        Route::get('/messages','index');
        Route::get('/messages/{email}','getMessage');
    });
});

require __DIR__.'/auth.php';

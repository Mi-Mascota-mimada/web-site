<?php

namespace App\Providers;

use App\Models\Messages;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        $websiteSetting = Setting::first();
        View::share('appSetting', $websiteSetting);

        //$messages = Messages::orderBy('id','DESC')->take(5)->get();
        $messages = Messages::select('id', 'name', 'email', 'message','cel', 'created_at')->orderBy('created_at', 'desc')->get()->groupBy('email');
        View::share('messages', $messages);

        $todayDate = Carbon::now()->format('Y-m-d');
        $todayOrders = Order::whereDate('created_at', $todayDate)->get();
        View::share('notifications', $todayOrders);
    }
}

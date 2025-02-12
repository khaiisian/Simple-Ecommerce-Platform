<?php

namespace App\Providers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::composer('*', function ($view) {
            $cart = Session::get('cart', []); // Retrieve cart from session
            $cartCount = count($cart); // Get cart item count
            $msg = "success";
            $view->with('cart', $cart)->with('cartCount', $cartCount)->with('msg', $msg);
        });
    }
}
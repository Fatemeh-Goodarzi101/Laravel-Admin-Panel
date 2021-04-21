<?php

namespace App\Helpers\Cart;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Cart\CartService;

class CartServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('cart' , function() {
            return new CartService();
        });
    }
}
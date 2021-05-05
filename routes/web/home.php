<?php

use App\Http\Controllers\Auth\AuthTokenController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController as HomeIndexController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Profile\IndexController;
use App\Http\Controllers\Profile\OrderController;
use App\Http\Controllers\Profile\TokenAuthController;
use App\Http\Controllers\Profile\TwoFactorAuthController;
use App\Models\ActiveCode;
use App\Models\Comment;
use App\Models\Permission;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Notifications\LoginNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Morilog\Jalali\Jalalian;

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

Route::get('/', [HomeIndexController::class , 'index']);

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function() {
    Route::prefix('profile')->group(function(){  
        Route::get('/' , [IndexController::class, 'index'])->name('profile');
        Route::get('twofactor' , [TwoFactorAuthController::class, 'manageTwoFactor'])->name('profile.2fa.manage');
        Route::post('twofactor' , [TwoFactorAuthController::class, 'postManageTwoFactor']);
    
        Route::get('twofactor/phone' , [TokenAuthController::class, 'getPhoneVerifyCode'])->name('profile.2fa.phone');
        Route::post('twofactor/phone' , [TokenAuthController::class, 'postPhoneVerifyCode']);

        Route::get('orders' , [OrderController::class , 'index'])->name('profile.orders');
        Route::get('orders/{order}' , [OrderController::class , 'showDetails'])->name('profile.orders.detail');
        Route::get('orders/{order}/payment' , [OrderController::class , 'payment'])->name('profile.orders.payment');
    });

    Route::post('comments' , [HomeController::class , 'comment'])->name('send.comment');
    Route::post('payment' , [PaymentController::class , 'payment'])->name('cart.payment');
    Route::get('payment/callback' , [PaymentController::class , 'callback'])->name('payment.callback');
});

Route::get('/auth/google' , [GoogleAuthController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback' , [GoogleAuthController::class, 'callback']);
Route::get('/auth/token' , [AuthTokenController::class, 'getToken'])->name('2fa.token');
Route::post('/auth/token' , [AuthTokenController::class, 'postToken']);


Route::get('categories/{category}' , [ProductController::class , 'index'])->name('category');
Route::get('categories' , [ProductController::class , 'index']);
Route::get('products/{product}' , [ProductController::class , 'single'])->name('product.single');


Route::get('cart' , [CartController::class , 'cart']);
Route::post('cart/add/{product}' , [CartController::class , 'addToCart'])->name('cart.add');
Route::patch('/cart/quantity/change' , [CartController::class , 'quantityChange']);
Route::delete('cart/delete/{cart}' , [CartController::class , 'deleteFromCart'])->name('cart.destroy');

Route::prefix('discount')->middleware('auth')->group(function() {
    Route::post('check', [DiscountController::class , 'check'])->name('cart.discount.check');
    Route::delete('delete' , [DiscountController::class , 'destroy']);
});
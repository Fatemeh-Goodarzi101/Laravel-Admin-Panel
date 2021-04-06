<?php

use App\Http\Controllers\Auth\AuthTokenController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Profile\IndexController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/auth/google' , [GoogleAuthController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback' , [GoogleAuthController::class, 'callback']);
Route::get('/auth/token' , [AuthTokenController::class, 'getToken'])->name('2fa.token');
Route::post('/auth/token' , [AuthTokenController::class, 'postToken']);


Route::prefix('profile')->middleware('auth')->group(function(){  
    Route::get('/' , [IndexController::class, 'index'])->name('profile');
    Route::get('twofactor' , [TwoFactorAuthController::class, 'manageTwoFactor'])->name('profile.2fa.manage');
    Route::post('twofactor' , [TwoFactorAuthController::class, 'postManageTwoFactor']);

    Route::get('twofactor/phone' , [TokenAuthController::class, 'getPhoneVerifyCode'])->name('profile.2fa.phone');
    Route::post('twofactor/phone' , [TokenAuthController::class, 'postPhoneVerifyCode']);
});


Route::get('products' , [ProductController::class , 'index']);
Route::get('products/{product}' , [ProductController::class , 'single']);

Route::post('comments' , [HomeController::class , 'comment'])->name('send.comment');
Route::get('cart' , function() {
    dd(Cart::get('2'));
});
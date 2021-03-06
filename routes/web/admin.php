<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\User\PermissionController as UserPermissionController;
use App\Http\Controllers\Admin\User\UserController;
use Illuminate\Support\Facades\Route as Route;


Route::get('/' , [PanelController::class , 'index'])->name('admin');

Route::resource('users' , UserController::class);
Route::get('/users/{user}/permissions' , [UserPermissionController::class , 'create'])->name('users.permissions')->middleware('can:staff-user-permissions');
Route::post('/users/{user}/permissions' , [UserPermissionController::class , 'store'])->name('users.permissions.store')->middleware('can:staff-user-permissions');

Route::resource('permissions' , PermissionController::class);
Route::resource('roles' , RoleController::class);

Route::resource('products' , ProductController::class);
Route::resource('products.gallery' , ProductGalleryController::class);
Route::post('attribute/values' , [AttributeController::class , 'getValues']);

Route::resource('comments' , CommentController::class)->only(['index' , 'update' , 'destroy']);
Route::get('comments/unapproved' , [CommentController::class , 'unapproved'])->name('comments.unapproved');

Route::resource('categories' , CategoryController::class);

Route::resource('orders' , OrderController::class);
Route::get('orders/{order}/payments' , [OrderController::class , 'payments'])->name('orders.payments');

Route::resource('discounts' , DiscountController::class);
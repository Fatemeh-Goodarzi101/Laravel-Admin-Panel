<?php

namespace App\Http\Controllers;

use App\Helpers\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Discount;

class DiscountController extends Controller
{
    public function check(Request $request)
    {
        $validData = $request->validate([
            'discount' => 'required|exists:discounts,code',
            'cart' => 'required'
        ]);

        $discount = Discount::where('code' , $validData['discount'])->first();

        if( $discount->expired_at < now() ) {
            return back()->withErrors([
                'discount' => 'مهلت استفاده از این کد تخفیف به پایان رسیده است'
            ]);
        }
        
        if( $discount->users()->count() ) {
            if( ! in_array(auth()->user()->id , $discount->users->pluck('id')->toArray() )) {
                return back()->withErrors([
                    'discount' => 'شما قادر به استفاده از این کد تخفیف نیستید '
                ]);
            }
        }

        $cart = Cart::instance($validData['cart']);
        $cart->addDiscount($discount->code);

        return back();
    }

    public function destroy(Request $request)
    {
        $cart = Cart::instance($request->cart);
        $cart->addDiscount(null);

        return back();
    }
}

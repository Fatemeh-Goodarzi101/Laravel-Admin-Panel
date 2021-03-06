<?php

namespace App\Http\Controllers;

use App\Helpers\Cart\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        $this->seo()
            ->setTitle('سبد خرید')
            ->setDescription('به وب سایت دیجی کالا خوش امدید');

        return view('pages.cart');
    }

    public function addToCart(Product $product)
    {
        $cart = Cart::instance('cart-digikala');

        if($cart->has($product)) {
            if($cart->count($product) < $product->inventory)
                $cart->update($product , 1);
        }
        else{
            $cart->put(
                [
                    'quantity' => 1,
                ],
                $product
            );
        }
        return redirect('/cart');
    }

    public function quantityChange(Request $request)
    {
        $data = $request->validate([
            'quantity' => 'required',
            'id' => 'required',
            'cart' => 'required'
        ]);

        $cart = Cart::instance($data['cart']);


        if($cart->has($data['id']) ) {

            // $product = Cart::get($data['id'])['product'];
            // if(Cart::has($data['id']) && $data['quantity'] > $product->inventory) {

                $cart->update($data['id'] , [
                    'quantity' => $data['quantity']
                ]);
                return response(['status' => 'success']);

            // }
        }
        return response(['status' => 'error'] , 404);
    }

    public function deleteFromCart($id)
    {
        Cart::delete($id);
        return back();
    }
}

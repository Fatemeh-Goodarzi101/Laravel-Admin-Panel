<?php

namespace App\Http\Controllers;

use App\Helpers\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use PayPing\Payment;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as ShetabitPayment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

class PaymentController extends Controller
{
    public function payment()
    {
        $cart = Cart::instance('cart-digikala');
        $cartItems = $cart->all();
        if($cartItems->count()) {
            $price = $cartItems->sum(function($cart) {
                return $cart['discount_percent'] == 0 
                    ? $cart['product']->price * $cart['quantity']
                    : ( $cart['product']->price - ($cart['product']->price * $cart['discount_percent']) ) * $cart['quantity'];          
            });
            
            $orderItems = $cartItems->mapWithKeys(function($cart) {
                return [ $cart['product']->id => ['quantity' => $cart['quantity'] ] ];
            });
            

            $order = auth()->user()->orders()->create([
                'status' => 'unpaid',
                'price' => $price
            ]);

            $order->products()->attach($orderItems);

            // $invoice = (new Invoice)->amount($price);
            $invoice = (new Invoice)->amount(1000);

            return ShetabitPayment::callbackUrl(route('payment.callback'))->purchase($invoice, function($driver, $transactionId) use($order,$cart,$invoice) {

                $order->payments()->create([
                    'res_number' => $invoice->getUuid(),
                ]);
    
                $cart->flush();
            })->pay()->render();
            
        }

        alert()->error('محصولی برای پرداخت وجود ندارد');
        return back();
    }
    
    public function callback(Request $request)
    {
        try {

            $payment = Payment::where('res_number' , $request->clientrefid)->firstOrFail();

            // $payment->order->price 
            $receipt = ShetabitPayment::amount(1000)->transactionId($request->clientrefid)->verify();

            $payment->update([
                'status' => 1
            ]);

            $payment->order()->update([
                'status' => 'paid'
            ]);

            // alert()->success('پرداخت شما موفقیت آمیز بود');
            // return redirect();

            echo $receipt->getReferenceId();
            
        } catch (InvalidPaymentException $exception) {
           
            // return $exception->getMessage();

            alert()->error($exception->getMessage());
            return redirect();
        }
    }
}

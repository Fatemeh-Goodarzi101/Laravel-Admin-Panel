<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as ShetabitPayment;

class OrderController extends Controller
{
    public function index()
    {
        $this->seo()
        ->setTitle('لیست سفارشات')
        ->setDescription('به وب سایت دیجی کالا خوش امدید');

        $orders = auth()->user()->orders()->latest('created_at')->paginate(10);
        return view('profile.orders-list' , compact('orders'));
    }

    public function showDetails(Order $order)
    {
        $this->seo()
        ->setTitle('جزئیات سفارشات')
        ->setDescription('به وب سایت دیجی کالا خوش امدید');

        $this->authorize('view' , $order);
        return view('profile.order-detail' , compact('order'));
    }

    public function payment(Order $order)
    {
        $this->authorize('view' , $order);

        // $invoice = (new Invoice)->amount($order->price);
        $invoice = (new Invoice)->amount(1000);

        return ShetabitPayment::callbackUrl(route('payment.callback'))->purchase($invoice, function($driver, $transactionId) use($order,$invoice) {

            $order->payments()->create([
                'res_number' => $invoice->getUuid(),
            ]);

        })->pay()->render();
    }
}

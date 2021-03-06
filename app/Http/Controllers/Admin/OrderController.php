<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->seo()
            ->setTitle('سفارشات')
            ->setDescription('به وب سایت دیجی کالا خوش امدید');

        $orders = Order::query();

        if($search = \request('search')){
            $orders->where('id' , $search)->orWhere('tracking_serial' , $search);
        }

        $orders = $orders->where('status' , request('type'))->latest()->paginate(10);
        return view('admin.orders.all' , compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $products = $order->products()->paginate(10);
        return view('admin.orders.details' , compact('products' , 'order'));
    }


    public function payments(Order $order)
    {
        $payments = $order->payments()->latest()->paginate(10);
        return view('admin.orders.payments' , compact('payments' , 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('admin.orders.edit' , compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $data = $this->validate($request ,[
            'status' => 'required' , Rule::in(['unpaid' , 'paid' , 'preparation' , 'posted' , 'received' , 'canceled']) ,
            'tracking_serial' => 'required|numeric'
        ]);

        $order->update($data);
        alert()->success('سفارش با موفقیت ویرایش شد');

        return redirect(route('admin.orders.index') . "?type=$order->status");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        alert()->success('سفارش با موفقیت حذف شد');
        return back();
    }
}

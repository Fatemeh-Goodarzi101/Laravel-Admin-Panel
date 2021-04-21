<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Validation\Rule;
use App\Models\Discount;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $discounts = Discount::latest()->paginate(10);
        return view('admin.discounts.all' , compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin.discounts.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $valiData = $request->validate([
            'code' => 'required|unique:discounts,code',
            'percent' => 'required|integer|between:1,99',
            'users' => 'nullable|array|exists:users,id',
            'products' => 'nullable|array|exists:products,id',
            'categories' => 'nullable|array|exists:categories,id',
            'expired_at' => 'required'
        ]);
        
        $discount = Discount::create($valiData);

        $discount->users()->attach($valiData['users']);
        $discount->categories()->attach($valiData['categories']);
        $discount->products()->attach($valiData['products']);

        return redirect(route('admin.discounts.index'));
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Discount $discount)
    {
        return view('admin.discounts.edit' , compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Discount $discount)
    {
        $valiData = $request->validate([
            'code' => ['required' , Rule::unique('discounts' , 'code')->ignore($discount->id)],
            'percent' => 'required|integer|between:1,99',
            'users' => 'nullable|array|exists:users,id',
            'products' => 'nullable|array|exists:products,id',
            'categories' => 'nullable|array|exists:categories,id',
            'expired_at' => 'required'
        ]);
        
        $discount->update($valiData);
        
        isset($valiData['users'])
            ? $discount->users()->sync($valiData['users'])
            : $discount->users()->detach();
        
        isset($valiData['categories'])
            ? $discount->categories()->sync($valiData['categories'])
            : $discount->categories()->detach();
        
        isset($valiData['products'])
            ? $discount->products()->sync($valiData['products'])
            : $discount->products()->detach();
        
        return redirect(route('admin.discounts.index'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();
        alert()->success('کد تخفیف مورد نظر با موفقیت حذف شد');

        return back();
    }
}

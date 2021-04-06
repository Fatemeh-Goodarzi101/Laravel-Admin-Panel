<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;
use UxWeb\SweetAlert\SweetAlert;
// use SweetAlert;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::query();
        if( $keyword = request('search') ){
            $products->where('title' , 'LIKE' , "%{$keyword}%")->orWhere('id' , 'LIKE' , "%{$keyword}%");
        }

        $products =$products->paginate(10);
        return view('admin.products.all' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'price' => ['required' , 'integer'],
            'inventory' => ['required' , 'integer'],
            'categories' => ['required'],
            'attributes' => 'array'
        ]);

        $product = auth()->user()->products()->create($validData);
        $product->categories()->sync($validData['categories']);

        $this->attachAttributesToProduct($product , $validData);

        alert()->success('محصول مورد نظر با موفقیت ثبت شد' , 'با تشکر');

        return redirect(route('admin.products.index'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // return $product->attributes[0]->pivot->attribute;
        return view('admin.products.edit' , compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validData = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'price' => ['required' , 'integer'],
            'inventory' => ['required' , 'integer'],
            'categories' => ['required'],
            'attributes' => ['required'],
        ]);
    
        $product->update($validData);
        $product->categories()->sync($validData['categories']);

        $product->attributes()->detach();
        $this->attachAttributesToProduct($product , $validData);
        
        alert()->success('محصول مورد نظر با موفقیت ویرایش شد' , 'با تشکر');

        return redirect(route('admin.products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        alert()->success('محصول مورد نظر با موفقیت حذف شد' , 'با تشکر');
        
        return back();
    }

    protected function attachAttributesToProduct(Product $product , array $validData): void
    {
        $attributes = collect($validData['attributes']);
        $attributes->each(function($item) use ($product) {
            if(is_null($item['name']) || is_null($item['value'])) return;

            $attr = Attribute::firstOrCreate([
                'name' => $item['name']
            ]);

            $attr_value = $attr->values()->firstOrCreate([
                'value' => $item['value']
            ]);

            $product->attributes()->attach($attr->id , ['value_id' => $attr_value->id ]);
            
        });
    }
}

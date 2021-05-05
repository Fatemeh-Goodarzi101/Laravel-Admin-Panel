<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request , Category $category)
    {
        $this->seo()
        ->setTitle('لیست محصولات')
        ->setDescription('به وب سایت دیجی کالا خوش امدید');
        
        if($request->category != null) {
            $products = $request->category->products;
            $category = $request->category;
        }
        else {
            $products = Product::latest()->get();
        }

        $categories = Category::all();
        return view('pages.categories' , compact('products' , 'category' , 'categories'));
    }

    public function single(Product $product)
    {
        $this->seo()
        ->setTitle('جزئیات محصول')
        ->setDescription('به وب سایت دیجی کالا خوش امدید');
       
        $catId = $product->categories()->first()->id;
        $relatedProducts = Product::query() ->whereHas('categories', function ($query) use($catId , $product) {
            $query->where('id','=', $catId)->where('product_id' , '!=' , $product->id);
        })->with('categories')->get();
        
        return view('pages.single-product' , compact('product' , 'relatedProducts'));
    }
}

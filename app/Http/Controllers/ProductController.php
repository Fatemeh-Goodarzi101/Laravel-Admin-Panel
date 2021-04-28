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

        return view('pages.categories' , compact('products' , 'category'));
    }

    public function single(Product $product)
    {
        $this->seo()
        ->setTitle('جزئیات محصول')
        ->setDescription('به وب سایت دیجی کالا خوش امدید');

        return view('home.single-product' , compact('product'));
    }
}

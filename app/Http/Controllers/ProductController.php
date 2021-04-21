<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $this->seo()
        ->setTitle('لیست محصولات')
        ->setDescription('به وب سایت دیجی کالا خوش امدید');

        $products = Product::latest()->paginate(10);
        return view('home.products' , compact('products'));
    }

    public function single(Product $product)
    {
        $this->seo()
        ->setTitle('جزئیات محصول')
        ->setDescription('به وب سایت دیجی کالا خوش امدید');

        return view('home.single-product' , compact('product'));
    }
}

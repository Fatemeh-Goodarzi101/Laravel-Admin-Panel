<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $this->seo()
        ->setTitle('صفحه اصلی')
        ->setDescription('به وب سایت دیجی کالا خوش امدید');

        $categories = Category::with('products')->get();
        return view('pages.home' , compact('categories')); 
    }
}

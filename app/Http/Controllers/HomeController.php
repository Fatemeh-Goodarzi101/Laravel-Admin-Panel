<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->seo()
        ->setTitle('صفحه اصلی')
        ->setDescription('به وب سایت دیجی کالا خوش امدید');

        $categories = Category::with('products')->get();
        return view('pages.home' , compact('categories')); 
    }

    public function comment(Request $request)
    {
        $validData = $request->validate([
            'commentable_id' => 'required',
            'commentable_type' => 'required',
            'parent_id' => 'required',
            'comment' => 'required',
        ]);

        auth()->user()->comments()->create($validData);
            
        alert()->success('نظر با موفقیت ثبت شد');
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $this->seo()
        ->setTitle('صفحه اصلی')
        ->setDescription('به وب سایت دیجی کالا خوش امدید');

        return view('home');
    }
}

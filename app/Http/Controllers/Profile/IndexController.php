<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $this->seo()
        ->setTitle('پروفایل شخصی')
        ->setDescription('به وب سایت دیجی کالا خوش امدید');

        return view('profile.index');
    }
}

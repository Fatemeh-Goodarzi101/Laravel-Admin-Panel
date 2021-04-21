<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index()
    {
        $this->seo()
        ->setTitle('پنل مدیریت')
        ->setDescription('به وب سایت دیجی کالا خوش امدید');

        return view('admin.index');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Models\User;
use Illuminate\Http\Request;

class AuthTokenController extends Controller
{
    public function getToken(Request $request)
    {
        if(! $request->session()->has('auth')){
            return redirect('/');
        }

        $request->session()->reflash();

        $this->seo()
        ->setTitle('احراز هویت دو مرحله ای')
        ->setDescription('به وب سایت دیجی کالا خوش امدید');

        return view('auth.token'); 
    }

    public function postToken(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);

        if(! $request->session()->has('auth')){
            return redirect(route('login'));
        }

        $user = User::findOrFail($request->session()->get('auth.user_id'));

        $status = ActiveCode::verifyCode($request->token , $user);

        if(! $status){
            alert()->error('کد صحیح نبود');
            return redirect(route('login'));
        }

        if(auth()->loginUsingId($user->id , $request->session()->get('auth.remember'))){
            $user->activeCode()->delete();
            return redirect('/');
        }

        return redirect(route('login'));
    }
}

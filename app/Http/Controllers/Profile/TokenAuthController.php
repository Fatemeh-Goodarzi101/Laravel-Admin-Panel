<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use Illuminate\Http\Request;

class TokenAuthController extends Controller
{
    public function getPhoneVerifyCode(Request $request)
    {
        if(! $request->session()->has('phone')){
            return redirect(route('profile.2fa.manage')); 
        }
        
        $request->session()->reflash();
        $this->seo()
        ->setTitle('تایید کد')
        ->setDescription('به وب سایت دیجی کالا خوش امدید');

        return view('profile.phone-verify');
    }

    public function postPhoneVerifyCode(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);

        if(! $request->session()->has('phone')){
            return redirect(route('profile.2fa.manage'));
        }

        $status = ActiveCode::verifyCode($request->token , $request->user());

        if($status){
            $request->user()->activeCode()->delete();
            $request->user()->update([
                'phone_number' => $request->session()->get('phone'),
                'two_factor_type' => 'sms'
            ]);
            alert()->success('شماره تلفن و احراز هویت دو مرحله ای شما تایید شد' , 'عملیات موفقیت آمیز بود');
        } else{
            alert()->error('شماره تلفن و احراز هویت دو مرحله ای شما تایید نشد' , 'عملیات ناموفق بود');
        }

        return redirect(route('profile.2fa.manage'));
    }

}

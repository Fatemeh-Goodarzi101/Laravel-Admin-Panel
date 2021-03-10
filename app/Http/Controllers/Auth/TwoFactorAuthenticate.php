<?php

namespace App\Http\Controllers\Auth;
use App\Models\ActiveCode;
use App\Notifications\ActiveCodeNotification;
use App\Notifications\LoginNotification;
use Illuminate\Http\Request;

trait TwoFactorAuthenticate
{
    public function loggedIn(Request $request , $user)
    {
        if($user->hasTwoFactorAuthenticatedEnabled()){
            return $this->logoutAndRedirectToTokenEntry($request , $user);
        }

        $user->notify(new LoginNotification());
        
        return false;
    }

    public function logoutAndRedirectToTokenEntry(Request $request , $user)
    {
        auth()->logout();
         
            $request->session()->flash('auth' , [
                'user_id' => $user->id,
                'using_sms' => false,
                'remember' => $request->has('remember')
            ]);

            if($user->two_factor_type == 'sms'){
                $code = ActiveCode::generateCode($user);
                // TODO Send Sms
                $user->notify(new ActiveCodeNotification($code , $user->phone_number));
                
                $request->session()->push('auth.using_sms' , true);
            }

            return redirect(route('2fa.token'));
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    use TwoFactorAuthenticate;

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        try{
            
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->email)->first();

            if(! $user){
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => bcrypt(\Str::random(16)),
                    'two_factor_type' => 'off'
                ]);
            }
            
            if( ! $user->hasVerifiedEmail()){
                $user->markEmailAsVerified();
            }

            auth()->loginUsingId($user->id);

            return $this->loggedIn($request , $user) ?: redirect('/');

        } 
        catch(\Exception $e){
            // TODO log error message

            alert()->error('ورود با گوگل موفق نبود' , 'شما ارور دارید')->persistent('بسیار خوب');
            return redirect('/login');
        }
    }
}

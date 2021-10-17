<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
  
use Auth;
use Exception;  
use Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
    
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
     
            if($finduser){
                Auth::login($finduser);    
                return redirect('/home');
     
            }else{
                $newUser = User::create([
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('newUser1234')
                ]);
    
                Auth::login($newUser);
                return redirect('/home');
            }
    
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

}
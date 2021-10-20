<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\Role;

use Auth;
use Exception;  
use Socialite;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
    
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('facebook_id', $user->id)->first();
     
            if($finduser){
                Auth::login($finduser);    
                return redirect('/user/dashboard');
     
            }else{
                $role = Role::where('name', 'user')->first();
                $newUser = User::create([
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id'=> $user->id,
                    'password' => encrypt('newUser1234')
                ]);

                $newUser->assignRole($role);
                Auth::login($newUser);
                return redirect('/user/dashboard');
            }
    
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

}
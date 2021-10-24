<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Role;
use App\Models\User;

use Auth;
use Exception;  
use Socialite;
use App\Http\Controllers\UserController;

class SocialMediaController extends Controller
{
    //

    public function redirectToProvider($provider)
   {
       return Socialite::driver($provider)->redirect();
   }

   public function handleProviderCallback($provider)
   {
//       dd($provider);
       try {
    
        $user = Socialite::driver($provider)->user();
        $finduser = User::where('provider_id',  $user->id)->first();
        if($finduser){
            Auth::login($finduser);    
            return redirect('/user/dashboard');
 
        }else{
            $role = Role::where('name', 'user')->first();
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'provider_id'=> $user->id,
                'provider' => $provider,
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

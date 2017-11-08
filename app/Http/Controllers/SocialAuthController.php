<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use Socialite;

class SocialAuthController extends Controller
{
     public function redirect($service2)
    {


        return Socialite::driver($service2)->redirect();   
    }   

    public function callback(SocialAccountService $service, $service2)
    {
        
//dd(Socialite::driver($service2)->user());
        $user = $service->createOrGetUser(Socialite::driver($service2)->user(), $service2);
        //dd($user);

        auth()->login($user);

        return redirect()->to('/');
    }
}

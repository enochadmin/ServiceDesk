<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator,Redirect,Response,File;
use Socialite;
use Auth;
use App\Models\User;

class SocialController extends Controller
{
    // THIS CONTROLLER IS USED FOR SSO AUTHENTICATION FOR GOOGLE AND MICROSOFT

    // google oauth redirect function
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }
    // google oauth callback funtion
    public function callback(){
        try {
            $user = Socialite::driver('google')->user();
            
        } catch (\Exception $e) {
            return back()->with('error', 'Connetion Error');
        }
        // only allow people with @company.com to login
        // if (explode("@", $user->email)[1] !== 'ienetworksolutions.com') {
            //return back()->with('error', 'User does not exist in our database');
        // }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            // log them in
          Auth::login($existingUser);
          return redirect()->to('/dashboard');
        } else {
            // create a new user
            return back()->with('error', 'User does not exist in our database');
        }
    }

     // microsoft oauth redirect function
     public function redirectToMicrosoftProvider(){
        return Socialite::driver('graph')->setTenantId(env('GRAPH_TENANT_ID'))->redirect();
    }
    // microsoft oauth callback funtion 
    public function handleMicrosoftProviderCallback(){
        try {
            $user = Socialite::driver('graph')->setTenantId(env('GRAPH_TENANT_ID'))->stateless()->user();
        } catch (\Exception $e) {

            return back()->with('error', 'Connetion Error');
        }
        // only allow people with @company.com to login
        
        if (explode('@', $user->email)[1] !== 'ienetworks.co') {
            return back()->with('error', 'User doesnot exist in our database');
        }

        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            // log them in
            Auth::login($existingUser);
            return redirect()->to('/home');
        } else {
            // create a new user

            return back()->with('error', 'User doesnot exist in our database');
        }

    }

}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    // THIS CONTROLLER IS USED TO REGISTER, SIGN IN AND SIGNOUT CLIENT USERS BASED ON SANCTUM API
    // method to register new client users
    public function register(Request $request){
        // validate user information while registring
        $data = $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:4',
        ]);
        // create the user if validation has meet
        $user = User::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        // create token
        $token = $user->createToken('HELPEX-User Registration Token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }
    // method for logout
    public function logout(){
        // revoke loged in user's tokens
        auth()->user()->tokens()->delete();
        return response(['message' => 'You have logged out of the system.']);
    }
    // method for login
    public function login(Request $request){
        // validate user information while registring
         $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $user = User::where('email',$data['email'])->first();
        if(!$user || !Hash::check($data['password'] , $user->password)){
            return response(['message' => 'Invalid Login Attempt'], 401);
        }else{
            // create token
            $token = $user->createToken('HELPEX-User Registration Token')->plainTextToken;
            $response = [
                'user' => $user,
                'token' =>$token,
            ];
            return response($response,200);
        }
    }
    // update user password
    public function updatePassword(Request $request){
        // get currently logged in user password
        $user = auth()->user()->password;
        // validate user password update request
        $data = $request->validate([
            'old_password' => 'required',
            'password'     => 'required|confirmed|min:4',
        ]);

        // check if user old password match database password record
        if (Hash::check($data['old_password'] , $user)) {
            auth()->user()->password = Hash::make($data['password']);
            auth()->user()->save();
            return response(['message','Password updated successful']);
        }else{
            return response(['message','Invalid old password']);
        }
    }
    // delete my account
    public function deleteMyAccount(Request $request){
        // get the user
        $userpassword = auth()->user()->password;
        // request for password upon account deletion
        $data = $request->validate([
            'password' => 'required',
        ]);

        // check if auth user password match provided password
        if(Hash::check($data['password'], $userpassword)){
            $user = Auth::user();
            $user->delete();
            return response(['message','Account deleted successfully']);
        }else{
            return response(['message','Invalid password']);
        }
    }

}

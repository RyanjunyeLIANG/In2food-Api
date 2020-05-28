<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Contact;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validateData = $request->validate([
            'name'=>'required|max:55',
            'email'=>'email|required',
            'password'=>'required|confirmed',
            'privilege'=>'required|max:20',
            'firstName' => 'required|max:55',
            'lastName' => 'required|max:55',
            'phone' => 'required',
            'street' => 'required',
            'suburb' => 'required',
            'state' => 'required|max:20',
            'postcode' => 'required|max:4'
        ]);

        $validateData['password'] = bcrypt($validateData['password']);

        $user = User::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'password' => $validateData['password']
        ]);
        $accessToken = $user->createToken('authToken')->accessToken;

        $user->contacts()->firstOrCreate([
            'firstName' => $validateData['firstName'],
            'lastName' => $validateData['lastName'],
            'phone' => $validateData['phone'],
            'email' => $validateData['email']
        ]);

        $user->address()->firstOrCreate([
            'street' => $validateData['street'],
            'suburb' => $validateData['suburb'],
            'state' => $validateData['state'],
            'postcode' => $validateData['postcode']
        ]);
        
        return response(['user'=>$user->load('contacts', 'address'), 'access_token'=> $accessToken]);
    }

    public function index() {
        return response([
            'message' => 'This is a login page.'
        ]);
    }

    public function login(Request $request) {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(Auth::check()) {
            return response([
                'message' => 'user is already logged in.'
            ]);
        }

        if(!Auth::attempt($loginData)) {
            return response()->Json([
                'error'=> 'Invalid credentials'
            ]);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;
        
        return response([
            'user' => Auth::user(),
            'access_token' => $accessToken
        ]);
    }

    public function logout() {
        $accessToken = Auth::user()->token();
        $accessToken->revoke();
        return response()->Json([
            'User Logout'
        ]);
    }
}

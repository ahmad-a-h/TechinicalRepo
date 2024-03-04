<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class RegisterController extends BaseController
{
    public function index(){
        return view("auth.register");
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            "name" => "required",
            "email" => "email|required",
            "password" => "required|confirmed",
        ]);
        $userData = $request->all();
        $userData['password'] = bcrypt($request->password);

        // Create the user
        User::create($userData);
        auth()->attempt($request ->only('email','password'));
        return redirect()->route('Tasks');
    }
    public function login(){
        return view('auth.login');
    }
    public function SubmitLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        auth()->attempt( $request->only('email', 'password'));
        return redirect()->intended('/Tasks');
    }
    public function logout(){
        auth()->logout();
        return view('auth.login');
    }

}

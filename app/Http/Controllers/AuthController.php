<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     *
     * @param Request $request
     * @return redirect
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->route('home');
        } 
        
        return redirect()->back()->with('error','Username or Password is wrong!');
    }

    /**
     *
     * @return redirect
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

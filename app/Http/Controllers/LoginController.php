<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index() {
        return view("pages.login.index");
    }

    function auth(Request $request) {
        $credential = $request->validate([
            'name' => ['required'],
            'password' => ['required']
        ]);
        if (Auth::attempt($credential)) {
            return redirect()->intended("dashboard");
        }else {
            $credential = [
                "email" => $request->name,
                "password" => $request->password
            ];
            if ( Auth::attempt($credential) ) {
                return redirect()->intended("dashboard");
            }
        }
        return back()->with("danger", "The provided credentials do not match our records.");
    }
    
    function logout(){
        Auth::logout();
        return redirect()->route("login");
    }
}

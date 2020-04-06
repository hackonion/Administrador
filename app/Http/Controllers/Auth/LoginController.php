<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['only' => 'showLoginForm']);
    }

    public function showLoginForm(){
        return view('auth.login');
    }
    


    public function login(){
        $credenciales = $this->validate(request(),[
            'name' => 'required|string',
            'password' => 'required|string'

        ]);

        if(Auth::attempt($credenciales)){
            return  redirect()->route('dasboard');
        }
            return back()->withErrors(['name'=> trans('auth.failed')])
            ->withInput(request(['name']));
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}


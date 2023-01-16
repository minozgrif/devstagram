<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login'); 
    }

    public function store(Request $request)
    {
       $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required'
       ]);

       if(!auth()->attempt($request->only('email','password'), $request->remember)){
            return back()->with('mesnsaje', 'Credenciales incorrectas');
       }
       
       return redirect()->route('post.index', auth()->user()->username);

    }
}

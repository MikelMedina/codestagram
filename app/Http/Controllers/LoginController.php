<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() 
    {

        return view('auth.login');
    }

    public function store(Request $request)
    {


        //Comprobaciones del input
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        //Comprobar contraseña


        if(!Auth::attempt($data, $request->remember)) {
            return back()->withErrors(['login' => 'El correo o contraseña no son correctos'])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->route('profile', auth()->user()->username);



        //Crear la sesión

        //Redirigir al perfil o al feed


    }
}

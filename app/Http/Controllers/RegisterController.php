<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //Modificamos el username para que sea url friendly
        $request->request->add(['username' => Str::slug($request->username)]);

        $request->validate([
            'name' => ['required'],
            'username' => ['required', 'alpha_dash', 'unique:users', 'min:3', 'max:20', 'not_in:login,register, logout, editar-perfil, feed'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()]
        ]);

        

        
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        

        Auth::attempt($request->only('email', 'password'));

        return redirect()->route('profile', auth()->user()->username);


    }


}

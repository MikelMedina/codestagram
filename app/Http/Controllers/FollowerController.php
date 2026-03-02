<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user) 
    {
        // Evitar que un usuario se siga a sí mismo
        if($user->id === auth()->id()) {
            return back()->with('error', 'No puedes seguirte a ti mismo');
        }
        
        $user->followers()->attach(auth()->id());

        return back();
    }

    public function destroy(User $user)
    {
        
        $user->followers()->detach(auth()->id());

        return back();
    }
}

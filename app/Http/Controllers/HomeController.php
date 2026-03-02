<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    

    public function __construct()
    {
        
    }

    public function __invoke()
    {
        //Obtenemos el id de las persoans que seguimos y lo metemos en un array
        $ids = auth()->user()->following()->get()->pluck('id')->toArray();

        //Con los ids obtenidos conslutamos a la bd por todos sus posts y usamos el with para traer la info del user y evitar N + 1
        $posts = Post::whereIn('user_id', $ids)->latest()->with('user')->paginate(5);
        

        return view('feed.index', [
            'posts' => $posts
        ]);
    }
}

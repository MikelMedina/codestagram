<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\VarDumper\VarDumper;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        if(auth()->user()->username != $user->username) {
            return redirect()->route('profile', auth()->user()->username);
        }

        $this->authorize('create', Post::class);
        return view('profile.posts.create', [
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Policy
        $this->authorize('create', Post::class);

        //validar
        $request->validate([
            'imagen' => ['required'],
            'titulo' => ['required', 'max:255'],
            'descripcion' => ['sometimes', 'max:3000']
        ]);

        
        //Guardamos el post en la bd
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'imagen' => $request->imagen,
            'descripcion' => $request->descripcion ?? ''

        ]);

        return redirect()->route('profile', auth()->user()->username);

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Post $post)
    {
        $this->authorize('view', $post);

        $comentarios = $post->comentarios;

        return view('profile.posts.show', [
            'user' => $user,
            'post' => $post,
            'comentarios' => $comentarios
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //verificar con el policy si el que elimina el post es el dueño
        $this->authorize('delete', $post);
        
        $imagen_path = 'uploads/' . $post->imagen;
    
        //elimino la imagen de la BD
        Storage::disk('public')->delete($imagen_path);

        //Elimino el registro de la BD
        $post->delete();

        //Retorno al usuario a su perfil
        return redirect()->route('profile', auth()->user()->username);
    }
}

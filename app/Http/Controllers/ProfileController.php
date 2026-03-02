<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Symfony\Polyfill\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Drivers\Gd\Driver;
use PhpParser\Node\Stmt\TryCatch;

class ProfileController extends Controller
{

    public $seguidores;
    public $siguiendo;
    public $cantidad_posts;

    public function index(User $user) 
    {
        $posts = Post::where('user_id', $user->id)->latest()->with('user')->paginate(15);

        $this->cantidad_posts = Number::abbreviate($posts->count());
        $this->seguidores = Number::abbreviate($user->followers->count());
        $this->siguiendo = Number::abbreviate($user->following->count());



        return view('profile.index', [
            'user' => $user,
            'posts' => $posts,
            'seguidores' => $this->seguidores,
            'siguiendo' => $this->siguiendo,
            'cantidad_posts' => $this->cantidad_posts
        ]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);


        return view('profile.edit.index', [
            'user' => $user 
        ]); 
    }

    public function update(User $user, Request $request) 
    {
        $this->authorize('update', $user);

        //Validamos el request
        $request->validate([
            'username' => ['required', 'min:3', 'unique:users,username,' . auth()->id(), 'max:20', 'not_in:login,register, logout, editar-perfil, feed', 'alpha_dash'],
            'email' => ['required', 'email', 'unique:users,email,' . auth()->id()],
            'imagen' => ['nullable', 'image', 'mimes:jpg, jpeg, png', 'max:30000'],
            'password_actual' => ['required'],
            'password' => ['nullable', Password::min(8)->mixedCase()->numbers()->symbols()]
        ]);

        if(!Hash::check($request->password_actual, auth()->user()->password)) {
            return back()->withErrors(['password_actual' => 'La contraseña no es correcta'])->withInput();
        }

        //Encontrar registro de usuario
        $updateUser = auth()->user();
        
        //Actualizar registros
        $updateUser->username = $request->username;
        $updateUser->email = $request->email;
        
        if($request->password) {
            $updateUser->password = Hash::make($request->password);
        }

        //Si existe la imagen
        if($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
        
            //Crear un nombre para la imagen
            $nombreImagen  = Str::uuid() . '.' . $imagen->extension();
        
            //Crear el Path
            $path = public_path('storage/profile/' . $nombreImagen);

            
            //Creamos la instancia de la imagen
            $manager = new ImageManager(Driver::class);

            //leemos la imagen
            $image = $manager->read($imagen);

            //recortamos la imagen
            $image->cover(320, 320);
            
            //Guardamos la imagen 
            $image->save($path);

            if(auth()->user()->imagen) {
                Storage::disk('public')->delete('profile/' . auth()->user()->imagen);            
            }

            $updateUser->imagen = $nombreImagen;
        }

        $updateUser->save();

        //Redireccionar al perfil
        return redirect()->route('profile', $updateUser->username);
        
        


        
    }
}

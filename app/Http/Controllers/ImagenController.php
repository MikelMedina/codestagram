<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        // Validar que sea una imagen
        $request->validate([
            'file' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10240']
        ]);

        //Accedo al File del request
        $imagen = $request->file('file');
        
        //Genero un nombre para la imagen
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        //Declaro la ruta donde voy a guardarla
        $imagenPath = public_path('storage/uploads') . '/' . $nombreImagen;

        
        //Creo instancia de ImageManager
        $manager = new ImageManager(new Driver);

        //Leo la Imagen
        $image = $manager->read($imagen);

        //La recorto
        $image->cover(1080, 1080);

        //Y la guardo
        $image->save($imagenPath);

        //Retorno el nombre de la Imagen
        return response()->json(['imagen' => $nombreImagen]);
    }
}

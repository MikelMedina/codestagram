@extends('layouts.app')

@section('titulo')

@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@push('script')
    @vite('resources/js/dropzone/create-post.js')
@endpush

@section('contenido')
    <div class="md:flex md:items-center">

    <div class="md:w-1/2 px-10">
        <form enctype="multipart/form-data" action="{{route('imagen.upload')}}" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
            @csrf
            
        </form>
    </div>

    <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
        <form method="POST" action="{{route('post.create', auth()->user()->id)}}" novalidate>
            @csrf
            <div class="mb-5">
                <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                    Nombre
                </label>
                <input 
                    type="text"
                    id="titulo"
                    name="titulo"
                    placeholder="Titulo de la publicación"
                    class="border p-3 w-full @error('titulo') border-red-500  @enderror rounded-lg"
                />

                @error('titulo')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">
                        {{$message}}
                    </p>
                @enderror


                
            </div>

            <div class="mb-5">
                <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                    Descripción
                </label>
                <textarea 
                    id="descripcion"
                    name="descripcion"  
                    placeholder="Descripcion de la publicación"
                    class="border p-3 w-full @error('descripcion') border-red-500 @enderror rounded-lg"
                ></textarea>
           
                @error('descripcion')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{$message}}
                    </p>
                @enderror

            </div>

            <div class="mb-5">
                <input 
                    name="imagen"
                    type="hidden"
                    value=""
                />
                

                @error('imagen')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{$message}}
                    </p>
                @enderror
            </div>

            <input
                type="submit"
                value="Crear Publicación"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
            />
        </form>
    </div>

</div>

@endsection
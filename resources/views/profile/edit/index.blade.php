@extends('layouts.app')

@section('titulo')
    Editar perfil: {{auth()->user()->username}}
@endsection


@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form class="mt-10 md:mt-0" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    Mensaje de estado
                </p>

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input 
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Tu Nombre de Usuario"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{auth()->user()->username}}"
                    />
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen Perfil
                    </label>
                    <input 
                        type="file"
                        id="imagen"
                        name="imagen"
                        class="border p-3 w-full rounded-lg"
                        accept=".jpg, .jpeg, .png"
                    />
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Cambiar Email</label>
                    <input 
                        type="email"
                        name="email"
                        id="email"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        placeholder="Tu Nuevo Email"
                        value="{{auth()->user()->email}}"
                    />
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password_actual" class="block mb-2 text-gray-500 font-bold uppercase">Tu Password</label>
                    <input 
                        type="password"
                        id="password_actual"
                        name="password_actual"
                        placeholder="Tu Password Actual"
                        class="border w-full p-3 rounded-lg @error('password_actual') border-red-500 @enderror"
                    />
                    
                    @error('password_actual')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="block mb-2 text-gray-500 font-bold uppercase">Cambiar Password</label>
                    <input 
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Tu Nueva Password"
                        class="border w-full p-3 rounded-lg @error('password') border-red-500 @enderror"
                    />
                    
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <input
                    type="submit"
                    value="Guardar Cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />

            </form>
        </div>
    </div>

@endsection
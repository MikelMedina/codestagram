@extends('layouts.app')


@section('titulo')
    {{$user->username}}
@endsection


@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ $user->imagen ? asset('/storage/profile') . '/' . $user->imagen : asset('img/usuario.svg') }}" alt="Imagen Usuario" class="rounded-full">
            </div>

            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col md:justify-center items-center py-10 md:py-10 md:items-start">
            
              

                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-2xl">{{$user->username}}</p>

                    @auth
                        @if(auth()->id() === $user->id)
                            <a href="{{route('perfil.edit', $user)}}" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
                                </svg>
                            </a>
                        @endif
                                        
                    @endauth

                </div>


                <p class="text-gray800 text-sm mb-3 font-bold mt-5">
                    {{$seguidores}}
                    <span class="font-normal">Seguidores</span>
                </p>

                {{-- COMPROBAR LOS DATOS QUE DEVUELVE LOS METODOS DE FOLLOWERS Y FOLLOWINGS DEL MODELO USER --}}

                <p class="text-gray800 text-sm mb-3 font-bold">
                    {{$siguiendo}}
                    <span class="font-normal">Siguiendo</span>
                </p>

                <p class="text-gray800 text-sm mb-3 font-bold">
                    {{$cantidad_posts}}
                    <span class="font-normal">Posts</span>
                </p>



                


                @auth
                    @if ($user->id != auth()->id())
                        @if($user->checkFollower(auth()->user())) 
                            <form action="{{route('unfollow', $user)}}" method="POST" >
                                @csrf 
                                @method('DELETE')
                                <input 
                                    type="submit"
                                    class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                    value="Dejar de Seguir"
                                />
                            </form>
                        @else
                            <form action="{{route('follow', $user)}}" method="POST" >
                                @csrf
                                <input 
                                    type="submit"
                                    class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                    value="Seguir"
                                />
                            </form>
                        @endif
                    @endif
                @endauth



            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10 p-5">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
        
        @can('viewAny', App\Models\Post::class)
            <x-listar-posts :posts="$posts" :user="$user" ></x-listar-posts>
        @endcan
        {{-- <div class="w-full flex flex-col gap-6 items-center">
            <p class="text-center text-gray-600">No hay posts</p>
        </div> --}}
    </section>

@endsection
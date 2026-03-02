@extends('layouts.app')


@section('titulo')
    Codestagram
@endsection

@section('contenido')
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6">
            @if($posts->count() > 0)
                @foreach ($posts as $post)
                    <a href="{{ route('post.show', [$post->user->username, $post->id]) }}" class="block bg-white rounded-lg shadow mb-8 overflow-hidden hover:shadow-lg transition-shadow duration-300 cursor-pointer">
                        <!-- Post Header -->
                        <div class="flex items-center gap-3 p-4 border-b">
                            <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-orange-400 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-lg">{{ strtoupper(substr($post->user->username, 0, 1)) }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 text-sm md:text-base">{{ $post->user->username }}</p>
                                <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <!-- Post Image -->
                        <div class="aspect-square overflow-hidden bg-gray-200">
                            <img 
                                src="{{ asset('storage/uploads/'. $post->imagen) }}" 
                                alt="{{ $post->titulo }}"
                                class="w-full h-full object-cover"
                            >
                        </div>

                        <!-- Post Actions -->
                        <div class="p-4">
                            <div class="flex items-center gap-6 mb-3">
                                <!-- Like Button -->
                                <livewire:like-post :post="$post" wire:key="like-{{ $post->id }}" />
                                
                                <!-- Comment Button -->
                                <div class="flex items-center gap-2 text-gray-700 hover:text-pink-500 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <span class="text-sm text-gray-600">{{ $post->comentarios->count() }}</span>
                                </div>
                            </div>

                    </a>
                @endforeach

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg shadow p-12 text-center">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">No hay posts aún</h3>
                    <p class="text-gray-500">Sigue a otras cuentas para ver sus posts aquí</p>
                </div>
            @endif
        </div>
    </div>
@endsection
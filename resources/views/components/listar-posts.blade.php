@props(['posts', 'user'])

<div>
    @if($posts->count()) 

        <div {{$attributes->class(['grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6'])}}>

   
            @foreach ($posts as $post)
                <div>
                    
                    <a href="{{route('post.show', ['user' => $post->user->username, 'post' => $post->id ])}}">
                        <img src="{{asset('storage/uploads/' . $post->imagen)}}" alt="Post: {{$post->titulo}}" class="w-full h-auto">
                    </a>

                    
                    {{ $slot }}

                </div>
            @endforeach

        

        </div>

        <div class="my-10">
            {{$posts->links('pagination::tailwind') }}
        </div>

    @else 
        <p class="text-center"> No hay ningún post</p>
    @endif

    

    

</div>

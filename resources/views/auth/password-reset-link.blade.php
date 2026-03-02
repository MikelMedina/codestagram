@extends('layouts.app')

@section('titulo')
   Recuperar Contraseña
@endsection

@section('contenido')
	<div class="md:flex md:justify-center md:gap-10 md:items-center">
		
		<div class="md:w-6/12 p-5">
			<img src="{{asset('img/recuperar.jpg')}}" alt="Imagen Login de Usuarios">
		</div>

		<div class="md:w-4/12 bg-white p-6 md:m-0 m-6 rounded-lg shadow-xl">
			<form novalidate method="POST">
				@csrf
				
				
				@if (session()->has('status'))
					<p class=" bg-green-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{session('status')}}</p>
					
				@endif

				@error('login')
					<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
						{{$message}}
					</p>
				@enderror
				
				<div class="mb-5">
					<label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
						Email
					</label>
					<input 
						type="email"
						id="email"
						name="email"
						placeholder="Escribe el email asociado a tu cuenta"
						class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
						value="{{old('email')}}"
					/>

					@error('email')
						<p  class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
					@enderror
				
				</div>



				<input
					type="submit"
					value="Iniciar Sesión"
					class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
				/>
			</form>
		</div>

	</div>

@endsection
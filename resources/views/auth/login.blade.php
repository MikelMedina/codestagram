@extends('layouts.app')

@section('titulo')
   Iniciar Sesión
@endsection

@section('contenido')
	<div class="md:flex md:justify-center md:gap-10 md:items-center">
		
		<div class="md:w-6/12 p-5">
			<img src="img/login.jpg" alt="Imagen Login de Usuarios">
		</div>

		<div class="md:w-4/12 bg-white p-6 md:m-0 m-6 rounded-lg shadow-xl">
			<form novalidate method="POST">
				@csrf

				@error('login')
					<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
						{{$message}}
					</p>
				@enderror
				{{-- @if($errors->has('login'))
					<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
						{{$message}}
					</p>
				@endif --}}
				
{{-- 
				@foreach ($errors->all() as  $error)
					<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
						{{$error}}
					</p>
				@endforeach --}}

				
				<div class="mb-5">
					<label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
						Email
					</label>
					<input 
						type="email"
						id="email"
						name="email"
						placeholder="Tu Email de Registro"
						class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
						value="{{old('email')}}"
					/>

					@error('email')
						<p  class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
					@enderror
				
				</div>

				<div class="mb-5">
					<label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
						Password
					</label>
					<input 
						type="password"
						id="password"
						name="password"
						placeholder="Password de registro"
						class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
					/>

					@error('password')
						<p  class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
					@enderror
				</div>

				<div class="mb-5 flex justify-between items-center">
					<div class="flex items-center gap-2">
						<input type="checkbox" id="remember" name="remember">
						<label for="remember" class="text-gray-500 text-sm">Mantener mi sesión abierta</label>
					</div>

					<a href="{{route("password.request")}}" class="text-gray-500 text-sm hover:text-sky-600 transition-colors">
						¿Olvidaste tu contraseña?
					</a>
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
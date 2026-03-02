@extends('layouts.app')


@section('titulo')
    Crear Nueva Contraseña
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
		
		<div class="md:w-6/12 p-5">
			<img src="{{ asset('img/recuperar.jpg') }}" alt="Imagen Login de Usuarios">
		</div>

		<div class="md:w-4/12 bg-white p-6 md:m-0 m-6 rounded-lg shadow-xl">
			<form novalidate method="POST">
				@csrf
				
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
				<div class="mb-5">
					<label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
						Password
					</label>
					<input 
						type="password"
						id="password"
						name="password"
						placeholder="Tu password"
						class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
						value="{{old('password')}}"
					/>

					@error('password')
						<p  class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
					@enderror
				
				</div>
				<div class="mb-5">
					<label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
						Confirma tu password
					</label>
					<input 
						type="password"
						id="password_confirmation"
						name="password_confirmation"
						placeholder="Repite Tu Password"
						class="border p-3 w-full rounded-lg @error('password_confirmation') border-red-500 @enderror"
						value="{{old('password_confirmation')}}"
					/>

					@error('password_confirmation')
						<p  class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
					@enderror
				
				</div>

                <input type="hidden" value="{{$token}}" name="token">

				<input
					type="submit"
					value="Cambiar Contraseña"
					class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
				/>
			</form>
		</div>

	</div>


@endsection
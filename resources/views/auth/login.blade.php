@extends('layouts.app')

@section('titulo')
    Inicia Sesion en DevStagram
@endsection
@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-6/12">
           <img src="{{asset('img/login.jpg')}}" alt="Imagen login de Usuarios" class="md:gap-10 md:items-center p-5"/>
        </div>
        <div class="md:w-4/12 bg-white p-6 rounted-lg shadow-xl">
            <form action="{{ route('login')}}" method="POST" novalidate>
                @csrf
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p2 text-center">{{ session('mensaje') }}</p> 
                @endif
                <div class="mb-5">
                    <label for='email' class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Tu Correo Electronico"
                        class="border p-3 w-full rounder-lg @error('name') border-red-500 @enderror"
                        value="{{ old('email')}}"
                    />
                    @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p2 text-center">{{ $message }}</p>
                     @enderror
                </div>
                <div class="mb-5">
                    <label for='pasword' class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Pasword de Registro"
                        class="border p-3 w-full rounder-lg @error('password') border-red-500 @enderror"
                    />
                    @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p2 text-center">{{ $message }}</p>
                     @enderror
                </div>
                <div class="mb-5">
                    <input type="checkbox" name="remember"> <label class="text-gray-500  text-sm ">Mantener mi Session abierta</label>

                </div>
               
                <input
                    type="submit"
                    value="Iniciar Sesion"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
            />
            </form>
        </div>
    </div>
@endsection
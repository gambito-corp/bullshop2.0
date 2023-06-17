@extends('layout.guest')

@section('title')
Login Perpetuo
@endsection

@section('content')

<div class="flex items-center justify-center min-h-screen bg-gray-200">

  <div class="flex-1 text-center">
    <form class="w-1/2 px-8 pt-6 pb-8 m-auto mb-4 bg-white rounded shadow-md" method="POST" action="{{route('auth.login')}}" x-data="{password_visible: false}">
        @csrf
        <h2 class="mb-4 text-xl">Iniciar Sesión</h2>
    
        <div class="mb-4">
            <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                Correo
            </label>
            <input class="w-full px-3 py-2 leading-tight text-gray-700 transition duration-500 border-b border-gray-300 rounded shadow appearance-none focus:outline-none focus:border-blue-500" id="email" type="email" name="email" required autofocus>
        </div>
    
        <div class="mb-6">
            <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                Contraseña
            </label>
            <input
                :type="password_visible ? 'text' : 'password'"
                class="w-full px-3 py-2 mb-3 leading-tight text-gray-700 transition duration-500 border-b border-gray-300 rounded shadow appearance-none focus:outline-none focus:border-blue-500"
                id="password"
                name="password"
                required>
            <p class="hidden text-xs italic text-red-500">Por favor, introduce tu contraseña.</p>
        </div>
    
        <div class="flex items-center justify-between">
            <button class="px-4 py-2 font-bold text-white transition duration-500 bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline" type="submit">
                Conectarse
            </button>
        </div>
    
    </form>
    
  </div>

  <div class="flex-1 bg-center bg-cover" style="background-image: url('https://placehold.co/1920x1080.mp4')">
    <h1>Hola mundo</h1>
  </div>

</div>

@endsection
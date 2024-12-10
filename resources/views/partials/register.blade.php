@extends('layouts.app')

@section('content')

<div class="w-full max-w-md mx-auto mt-2 mb-16 p-8 border rounded-lg shadow-lg bg-white">
    <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Daftar</h1>
    </header>

    <form method="POST" action="{{ route('register.post') }}" class="space-y-4">
        @csrf

        <div class="relative">
            <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input
                type="text"
                name="nama_lengkap"
                placeholder="Nama Lengkap"
                class="w-full px-4 py-3 pl-12 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 transition duration-300"
                required />
        </div>

        <div class="relative">
            <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input
                type="email"
                name="email"
                placeholder="Email"
                class="w-full px-4 py-3 pl-12 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 transition duration-300"
                required />
        </div>

        <div class="relative">
            <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input
                type="password"
                name="password"
                placeholder="Kata Sandi"
                class="w-full px-4 py-3 pl-12 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 transition duration-300"
                required />
        </div>

        <div class="relative">
            <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input
                type="password"
                name="password_confirmation"
                placeholder="Konfirmasi Kata Sandi"
                class="w-full px-4 py-3 pl-12 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 transition duration-300"
                required />
        </div>

        <button
            type="submit"
            class="w-full py-3 text-white bg-blue-600 rounded-md hover:bg-blue-700 transition transform hover:scale-105 duration-200">
            Daftar
        </button>
    </form>

    @if (session('error'))
    <p class="mt-4 text-center text-red-500">{{ session('error') }}</p>
    @endif

    <p class="mt-6 text-center text-gray-700">
        Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-semibold">Masuk Disini</a>
    </p>
</div>
@endsection
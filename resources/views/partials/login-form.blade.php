@extends('layouts.app3')

@section('content')

<div class="w-full max-w-md mx-auto mt-2 mb-16 p-8 border rounded-lg shadow-lg bg-white">
    <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Masuk</h1>
    <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
        @csrf

        <div class="relative">
            <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input
                type="text"
                name="username"
                placeholder="Email atau Nomor Telepon"
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

        <button
            type="submit"
            class="w-full py-3 text-white bg-blue-600 rounded-md hover:bg-blue-700 transition duration-200">
            Masuk
        </button>

    </form>

    <div class="flex items-center my-6">
        <hr class="flex-grow border-t-4 border-gray-300" />
        <span class="mx-4 text-gray-500 text-sm font-medium">Or Continue With</span>
        <hr class="flex-grow border-t-4 border-gray-300" />
    </div>

    <a
        href="{{ route('google.login') }}"
        class="flex items-center justify-center w-full py-3 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-100 transition duration-200 space-x-3">
        <i class="fab fa-google text-blue-500 text-lg"></i>
        <span class="font-medium">Login With Google</span>
    </a>


    @if (session('error'))
    <p class="mt-4 text-center text-red-500">{{ session('error') }}</p>
    @endif

    <p class="mt-6 text-center text-gray-700">
        Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-semibold">Daftar Disini</a>
    </p>
</div>
@endsection
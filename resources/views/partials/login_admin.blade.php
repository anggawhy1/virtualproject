@extends('layouts.header')

@section('content')
<main class="flex-grow w-full px-4 md:px-20 py-12 flex justify-center bg-gray-50 text-gray-800 font-sans min-h-screen">
    <div class="w-full max-w-md mx-auto mt-8 p-8 border rounded-lg shadow-lg bg-white">
        <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Masuk Admin</h1>

        @if(session('error'))
            <div class="bg-red-100 text-red-600 p-3 rounded mb-4 text-center">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
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

            <div class="flex justify-between items-center mb-4">

                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2"> Ingat saya
                </label>

                <a href="{{ route('password.request') }}" class="text-blue-600 text-sm">Reset Password?</a>
            </div>

            <button
                type="submit"
                class="w-full py-3 text-white bg-blue-600 rounded-md hover:bg-blue-700 transition transform hover:scale-105 duration-200">
                Masuk
            </button>
        </form>

        <div class="flex items-center my-10">
            <hr class="flex-grow border-t-4 border-gray-300" />
            <span class="mx-4 text-gray-500 font-medium">Atau Masuk Dengan</span>
            <hr class="flex-grow border-t-4 border-gray-300" />
        </div>

        <a
            href="{{ route('google.login') }}"
            class="flex items-center justify-center w-full py-3 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-100 transition duration-200">

            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-blue-500" viewBox="0 0 24 24" fill="currentColor">
                <path d="M21.35 11.1h-9.19v2.9h5.67c-.23 1.32-.92 2.44-1.94 3.2v2.63h3.14c1.83-1.7 2.89-4.19 2.89-6.93 0-.63-.06-1.25-.15-1.86z" />
                <path d="M12.16 21c2.48 0 4.56-.82 6.09-2.22l-3.14-2.63c-.84.57-1.91.91-3.11.91-2.39 0-4.41-1.62-5.13-3.78h-3.25v2.38c1.59 3.17 4.85 5.34 8.54 5.34z" />
                <path d="M6.93 12.4c-.19-.57-.29-1.18-.29-1.8s.1-1.23.29-1.8v-2.38h-3.25c-.64 1.21-1 2.59-1 4.18s.36 2.97 1 4.18l3.25-2.38z" />
                <path d="M12.16 4.73c1.35 0 2.57.47 3.53 1.37l2.63-2.63c-1.64-1.52-3.79-2.47-6.16-2.47-3.69 0-6.95 2.17-8.54 5.34l3.25 2.38c.72-2.16 2.74-3.78 5.13-3.78z" />
            </svg>
            Masuk dengan Google
        </a>

        <p class="mt-6 text-center text-gray-700">
            Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-semibold">Daftar Disini</a>
        </p>
    </div>
</main>
@endsection

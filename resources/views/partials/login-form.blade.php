<div class="w-full max-w-md mx-auto mt-0 p-8 border rounded-lg shadow-lg bg-white transition duration-500 ease-in-out transform hover:shadow-2xl">
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
                required
            />
        </div>
        <div class="relative">
            <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input
                type="password"
                name="password"
                placeholder="Kata Sandi"
                class="w-full px-4 py-3 pl-12 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 transition duration-300"
                required
            />
        </div>
        <button
            type="submit"
            class="w-full py-3 text-white bg-blue-600 rounded-md hover:bg-blue-700 transition transform hover:scale-105 duration-200"
        >
            Masuk
        </button>
    </form>

    <!-- Tombol Login Google -->
    <a href="{{ route('google.login') }}" class="w-full py-3 mt-4 text-white bg-red-600 rounded-md text-center hover:bg-red-700 transition transform hover:scale-105 duration-200">
        Masuk dengan Google
    </a>

    @if (session('error'))
        <p class="mt-4 text-center text-red-500">{{ session('error') }}</p>
    @endif

    <p class="mt-6 text-center text-gray-700">
        Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-semibold">Daftar Disini</a>
    </p>
</div>

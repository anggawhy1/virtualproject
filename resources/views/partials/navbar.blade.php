<nav class="sticky top-0 z-50 flex items-center justify-between px-10 md:px-20 py-4 bg-white shadow-lg border-b-2">
    <div class="flex items-center space-x-5 md:space-x-7">
        <img src="images/logo.png" alt="Logo" class="w-8 h-8 md:w-10 md:h-10" />

        @auth
        <a href="/beranda" class="text-gray-900 font-medium text-base hover:text-blue-600 transition duration-300 hidden sm:inline-block">Beranda</a>
        <a href="/tentang" class="text-gray-900 font-medium text-base hover:text-blue-600 transition duration-300 hidden sm:inline-block">Tentang</a>
        <a href="/lacakaduan" class="text-gray-900 font-medium text-base hover:text-blue-600 transition duration-300 hidden sm:inline-block">Lacak Aduan</a>
        <a href="/bantuan" class="text-gray-900 font-medium text-base hover:text-blue-600 transition duration-300 hidden sm:inline-block">Bantuan</a>
         @endauth

         @guest
            <a href="/" class="px-3 py-1.5 border-2 rounded-md text-gray-900 font-medium text-base hover:bg-gray-200 transition duration-300">Beranda</a>
        @endguest
    </div>

    <div class="space-x-2 md:space-x-4">
        @guest
            <a href="/register" class="px-3 py-1.5 border-2 rounded-md text-gray-900 font-medium text-base hover:bg-gray-200 transition duration-300">Daftar</a>
            <a href="/login" class="px-3 py-1.5 text-white bg-blue-600 rounded-md font-medium text-base hover:bg-blue-700 transition duration-300">Login</a>
        @endguest

        @auth
            <!-- Logged-in User Section -->
            <div class="flex items-center space-x-3 cursor-pointer relative group">
                <!-- User's Profile Image -->
                <div class="w-8 h-8 rounded-full overflow-hidden border-2 border-blue-600">
                    @if (Auth::user()->profile_photo)
                        <img src="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo) }}" alt="Profile" class="object-cover w-full h-full" />
                    @else
                        <div class="w-full h-full bg-gray-300 flex items-center justify-center text-gray-700 text-2xl font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <!-- User's Name -->
                <span class="text-gray-900 font-medium text-base">{{ Auth::user()->name }}</span>

                <!-- Dropdown Icon -->
                <i class="fas fa-caret-down ml-2"></i>

                <!-- Dropdown Menu -->
                <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-10 hidden">
                    <a href="/profile" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Profile</a>
                    <a href="/settings" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Settings</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="block w-full px-4 py-2 text-gray-800 text-left hover:bg-gray-200">Logout</button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>

<!-- Optional: Font Awesome for the dropdown icon -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<script>
    // Toggle dropdown visibility when hovering over the profile section
    const profileSection = document.querySelector('.relative');
    const dropdownMenu = profileSection.querySelector('div.absolute');

    profileSection.addEventListener('mouseenter', function () {
        dropdownMenu.classList.remove('hidden');
    });

    profileSection.addEventListener('mouseleave', function () {
        dropdownMenu.classList.add('hidden');
    });
</script>
<header class="w-full p-4 flex justify-between items-center bg-white border-b border-gray-300">

    <!-- Search Box -->
    <div class="relative w-1/2 flex items-center">
        <input 
            type="text" 
            class="w-full p-2 pl-4 pr-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Search...">
        <i class="fas fa-search absolute right-4 top-1/2 transform -translate-y-1/2 text-blue-600"></i>
    </div>

    <!-- Right Side: Messages and User Profile -->
    <div class="flex items-center space-x-8">

        <!-- Messages Icon -->
        <div class="relative">
            <a href="{{ route('admin.message') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-envelope text-lg"></i>
            </a>
        </div>

        <!-- User Profile -->
        <div class="flex items-center space-x-2">
           <a href="{{ route('admin.settings') }}" class="flex items-center space-x-2">
    <!-- Profile Image -->
    @if (Auth::user()->profile_photo) <!-- Check if the user has a profile picture -->
        <img 
            src="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo) }}" 
            alt="User Profile" 
            class="w-8 h-8 rounded-full">
    @else
        <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-gray-700 text-xl font-bold">
            {{ strtoupper(substr(Auth::user()->nama_lengkap, 0, 1)) }} <!-- Display the initial of the user's name -->
        </div>
    @endif

    <!-- Display Logged-In User's Name -->
    <span class="text-gray-700 text-sm">{{ Auth::user()->nama_lengkap ?? '-' }}</span>
</a>

        </div>
    </div>
</header>

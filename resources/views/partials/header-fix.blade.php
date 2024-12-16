<header class="w-full bg-white border-b border-gray-300">
    <div class="container mx-auto p-4 flex justify-between items-center">

    <!-- Left Side: (Optional, add your content here) -->

    <!-- Right Side: Messages and User Profile -->
    <div class="flex items-center space-x-8 ml-auto"> <!-- Add ml-auto to push this to the right -->

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

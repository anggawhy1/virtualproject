<header class="w-full bg-white border-b border-gray-300">
    <div class="container mx-auto p-4 flex justify-between items-center">

        <div class="flex items-center space-x-4 ml-auto">
            <!-- Search Bar -->
            <div class="relative w-64">

                <i class="fas fa-search text-blue-600 absolute left-4 top-1/2 transform -translate-y-1/2 cursor-pointer"
                   onclick="document.getElementById('search-input').focus()"></i>

                <input 
                    id="search-input"
                    type="text" 
                    placeholder="Cari User..." 
                    class="pl-12 pr-4 py-2 border border-blue-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 w-full text-gray-600">
            </div>

            <a href="{{ route('admin.settings') }}" class="flex items-center space-x-2">
                <!-- Profile Image -->
                @if (Auth::user()->profile_photo)
                    <img 
                        src="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo) }}" 
                        alt="User Profile" 
                        class="w-8 h-8 rounded-full">
                @else
                    <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-gray-700 text-xl font-bold">
                        {{ strtoupper(substr(Auth::user()->nama_lengkap, 0, 1)) }}
                    </div>
                @endif
                <!-- User Name -->
                <span class="text-gray-700 text-sm">{{ Auth::user()->nama_lengkap ?? '-' }}</span>
            </a>
        </div>
    </div>
</header>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

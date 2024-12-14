<header class="w-full p-4 flex justify-between items-center bg-white border-b border-gray-300">

    <div class="relative w-1/2 flex items-center">
        <input 
            type="text" 
            class="w-full p-2 pl-4 pr-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Search....">
        <i class="fas fa-search absolute right-4 top-1/2 transform -translate-y-1/2 text-blue-600"></i>
    </div>

    <div class="flex items-center space-x-8">

        <div class="relative">
            <a href="{{ route('admin.message') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-envelope text-lg"></i>
            </a>
        </div>

        <div class="flex items-center space-x-2">
            <a href="/admin/settings" class="flex items-center space-x-2">
                <img src="{{ asset('images/pict1.png') }}" alt="User Profile" class="w-8 h-8 rounded-full">
                <span class="text-gray-700">Admin</span>
            </a>
        </div>
    </div>
</header>

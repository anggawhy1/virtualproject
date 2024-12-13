<div class="flex min-h-screen">
    <aside class="w-64 p-4 pl-6 border border-gray-300 fixed top-0 left-0 h-full bg-white overflow-y-auto z-10">
        <div class="px-4">
            <div class="flex items-center space-x-2 mb-8">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="w-10 h-10">
                <span class="text-2xl font-semibold text-blue-600">LaporPak</span>
            </div>

            <nav class="space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center py-2 px-4 mb-4 bg-blue-600 text-white rounded-md transition">
                    <i class="fas fa-th mr-2"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.users') }}" class="flex items-center py-2 px-4 mb-4 text-blue-600 hover:bg-blue-600 hover:text-white rounded-md transition">
                    <i class="fas fa-user-cog mr-2"></i>
                    <span>Kelola User</span>
                </a>
                <a href="{{ route('admin.reports') }}" class="flex items-center py-2 px-4 mb-4 text-blue-600 hover:bg-blue-600 hover:text-white rounded-md transition">
                    <i class="fas fa-file-alt mr-2"></i>
                    <span>Kelola Laporan</span>
                </a>
                <a href="{{ route('admin.rewards') }}" class="flex items-center py-2 px-4 mb-4 text-blue-600 hover:bg-blue-600 hover:text-white rounded-md transition">
                    <i class="fas fa-gift mr-2"></i>
                    <span> Kelola Reward</span>
                </a>
                <a href="{{ route('admin.message') }}" class="flex items-center py-2 px-4 mb-4 text-blue-600 hover:bg-blue-600 hover:text-white rounded-md transition">
                    <i class="fas fa-comment mr-2"></i>

                    <span>Pesan</span>
                </a>
                <a href="{{ route('admin.settings') }}" class="flex items-center py-2 px-4 mb-4 text-blue-600 hover:bg-blue-600 hover:text-white rounded-md transition">
                    <i class="fas fa-cogs mr-2"></i>
                    <span>Settings</span>
                </a>

                <form action="{{ route('logout') }}" method="POST" id="logout-form">
    @csrf
    <a href="#" onclick="document.getElementById('logout-form').submit()" class="flex items-center py-2 px-4 mb-4 text-blue-600 hover:bg-blue-600 hover:text-white rounded-md transition">
        <i class="fas fa-sign-out-alt mr-2"></i>
        <span>Logout</span>
    </a>
</form>

            </nav>
        </div>
    </aside>

    <main class="flex-1 ml-64 p-8 bg-gray-50">
        <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

    </main>
</div>
<aside class="w-1/4 p-4 border border-gray-300 rounded-lg">
    <a
        href="/profile"
        class="flex items-center justify-start py-2 px-4 mb-4 border border-gray-300 rounded-md transition
        {{ Request::is('profile') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
        <i class="fas fa-user mr-2"></i> Edit Profil
    </a>

    <a
        href="/notifications"
        class="flex items-center justify-start py-2 px-4 mb-4 border border-gray-300 rounded-md transition
        {{ Request::is('notifications') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
        <i class="fas fa-bell mr-2"></i> Notifikasi
    </a>

    <a
        href="/laporan"
        class="flex items-center justify-start py-2 px-4 mb-4 border border-gray-300 rounded-md transition
        {{ Request::is('laporan') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
        <i class="fas fa-file-alt mr-2"></i> Laporan
    </a>

    <a
        href="/rewards"
        class="flex items-center justify-start py-2 px-4 mb-4 border border-gray-300 rounded-md transition
        {{ Request::is('rewards') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
        <i class="fas fa-gift mr-2"></i> Tukar Hadiah 
    </a>

    
</aside>
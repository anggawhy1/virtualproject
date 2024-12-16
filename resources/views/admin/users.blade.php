@extends('layouts.app-sidebar')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-blue-600">Kelola User</h1>

        <!-- Filter Dropdown -->
        <div class="relative">
            <button onclick="toggleFilter()" class="flex items-center px-4 py-2 border border-blue-600 rounded-lg text-blue-600">
                <i class="fas fa-filter mr-2 text-blue-600"></i> Filter
            </button>

            <div id="filterDropdown" class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg hidden">
              <form action="{{ route('admin.users') }}" method="GET" class="p-4">
    <h3 class="font-semibold text-sm">Filter Berdasarkan:</h3>
    <div class="mt-2">
        <label class="block text-sm">
            <input type="checkbox" name="roles[]" value="admin" 
                {{ in_array('admin', request('roles', [])) ? 'checked' : '' }} 
                class="mr-2"> Admin
        </label>
        <label class="block text-sm">
            <input type="checkbox" name="roles[]" value="user" 
                {{ in_array('user', request('roles', [])) ? 'checked' : '' }} 
                class="mr-2"> User
        </label>
    </div>
    <div class="mt-4 flex justify-end">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Terapkan</button>
    </div>
</form>

            </div>
        </div>
    </div>

    <!-- Tabel Pengguna -->
    <div class="bg-white border border-blue-600 rounded-lg shadow-md p-6">
        <table class="w-full table-auto">
            <thead>
                <tr>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Profil</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Nama Pengguna</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Email</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">No HP</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="py-2 px-4">
                            @if ($user->profile_photo)
                                <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}" alt="Profile" class="w-10 h-10 rounded-full">
                            @else
                                <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-700 text-2xl font-bold">
                                    {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }} 
                                </div>
                            @endif
                        </td>
                        <td class="py-2 px-4">{{ $user['nama_lengkap'] ?? 'Data tidak tersedia' }}</td>
                        <td class="py-2 px-4">{{ $user['email'] ?? 'Data tidak tersedia' }}</td>
                        <td class="py-2 px-4">{{ $user['phone'] ?? 'Data tidak tersedia' }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ route('users.show', $user['id']) }}" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-cogs text-lg"></i> 
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-sm text-gray-500">Tidak ada pengguna yang sesuai dengan filter</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    // Fungsi untuk toggle visibilitas dropdown filter
    function toggleFilter() {
        const filterDropdown = document.getElementById('filterDropdown');
        filterDropdown.classList.toggle('hidden'); // Menyembunyikan atau menampilkan dropdown
    }
</script>
@endsection

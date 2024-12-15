@extends('layouts.app-sidebar')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Kelola Reward</h1>

        <div class="relative">
            <button onclick="toggleFilter()" class="flex items-center px-4 py-2 border border-blue-600 rounded-lg text-blue-600">
                <i class="fas fa-filter mr-2 text-blue-600"></i> Filter
            </button>

            <div id="filterDropdown" class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg hidden">
                <div class="p-4">
                    <h3 class="font-semibold text-sm">Filter Berdasarkan:</h3>
                    <div class="mt-2">
                        <label class="block text-sm">
                            <input type="checkbox" name="role" value="Admin" class="mr-2"> Admin
                        </label>
                        <label class="block text-sm">
                            <input type="checkbox" name="role" value="User " class="mr-2"> User
                        </label>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" onclick="applyFilter()">Terapkan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white border border-blue-600 rounded-lg shadow-md p-6">
        <table class="w-full table-auto">
            <thead>
                <tr>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Pengguna</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Jumlah Point</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Status</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Aksi</th>
                </tr>
            </thead>
<tbody>
  @foreach ($userRewards as $userReward)
    <tr class="border-b">
        <td class="py-2 px-4 flex items-center">
            <span>{{ $userReward->user->nama_lengkap ?? 'Tidak tersedia' }}</span>
        </td>
        <td class="py-2 px-4">{{ $userReward->reward->points ?? 'Tidak tersedia' }}</td>
        <td class="py-2 px-4">
            {{ $userReward->status ?? 'Tidak tersedia' }} <!-- Menampilkan status dari pivot -->
        </td>
        <td class="py-2 px-4">
            <a href="{{ route('rewards.show', $userReward->id) }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-cogs text-lg"></i>
            </a>
        </td>
    </tr>
  @endforeach
</tbody>




        </table>
    </div>
</div>

<script>
    function toggleFilter() {
        const filterDropdown = document.getElementById('filterDropdown');
        filterDropdown.classList.toggle('hidden');
    }

    function applyFilter() {
        // Add your filtering logic here
        alert('Filter applied!');
        toggleFilter();
    }
</script>
@endsection
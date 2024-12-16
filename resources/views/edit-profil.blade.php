@extends('layouts.app')

@section('content')

    <div class="flex flex-grow gap-8 px-4 md:px-20 py-12 bg-gray-50 text-gray-800 font-sans min-h-screen">
        @include('partials.sidebar', ['active' => 'editprofil'])

        <main class="flex-grow max-w-4xl mx-auto p-6 bg-white border border-gray-300 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-blue-600 mb-8">Edit Profile</h1>

            @if (session('success'))
                <div class="mb-4 text-green-600 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-6 border border-gray-300 rounded-lg bg-white text-center">
                <div class="relative">
                    <img 
                        id="profilePhotoPreview"
                        src="{{ $user->profile_photo ? asset('storage/profile_photos/' . $user->profile_photo) : '' }}" 
                        alt="User Profile" 
                        class="w-24 h-24 rounded-full mx-auto mb-4 {{ $user->profile_photo ? '' : 'hidden' }}"
                    />
                    <div 
                        id="profilePlaceholder" 
                        class="w-24 h-24 rounded-full mx-auto mb-4 bg-gray-300 flex items-center justify-center text-gray-700 text-lg font-bold {{ $user->profile_photo ? 'hidden' : '' }}">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                </div>

                <form action="{{ route('update-profile-photo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex justify-center space-x-4 mt-4">
                        <label class="px-4 py-2 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition cursor-pointer">
                            <i class="fas fa-upload"></i> Upload Foto
                            <input 
                                type="file" 
                                name="profile_photo" 
                                id="profilePhotoInput" 
                                class="hidden" 
                                accept="image/*"
                                onchange="previewPhoto(event)">
                        </label>
                    </div>

                    <button type="submit" class="mt-8 w-full py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        Selesai
                    </button>
                </form>
            </div>
        </main>
    </div>

    <!-- Skrip didefinisikan langsung di sini -->
    <script>
        // Fungsi untuk menampilkan pratinjau foto
        function previewPhoto(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('profilePhotoPreview');
            const placeholder = document.getElementById('profilePlaceholder');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        }
    </script>

@endsection

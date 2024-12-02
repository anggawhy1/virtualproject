@extends('layouts.app')

@section('content')

<main class="flex-grow w-full px-4 md:px-20 py-6 bg-gray-50 text-gray-800 font-sans min-h-screen">
    <h1 class="text-3xl md:text-4xl font-bold text-blue-600 mb-8">Laporan</h1>
    <form action="{{ route('laporan.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf

        <div>
            <select
                name="kategori_id"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700"
                required
            >
                <option value="" disabled selected>Pilih Kategori Laporan</option>
                @foreach($kategori as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <textarea
                name="deskripsi"
                placeholder="Detail Laporan"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 resize-none"
                rows="4"
                required
            ></textarea>
        </div>

        <div class="relative">
            <input
                type="text"
                name="lokasi"
                placeholder="Tempat Kejadian"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700"
                
            />
            <span
                class="absolute inset-y-0 right-4 flex items-center cursor-pointer"
                onclick="openMap()"
                title="Pilih lokasi di Maps"
            >
                <img src="{{ asset('images/lokasi.png') }}" alt="Lokasi Icon" class="w-5 h-5" />
            </span>
        </div>

        <div>
            <!-- Hidden input fields for latitude and longitude -->
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
        </div>

        <div class="relative border border-gray-300 rounded-lg p-4 flex items-center justify-center text-gray-500 w-full">
    <label class="cursor-pointer w-full text-center">
        <input type="file" name="files[]" class="hidden" multiple />  <!-- Added 'multiple' here -->
        <span class="flex items-center justify-center space-x-2 text-blue-600 hover:underline">
            <img src="{{ asset('images/tambah.png') }}" alt="Tambah File Icon" class="w-5 h-5" />
            <span>Tambah File Pendukung</span>
        </span>
    </label>
</div>


       <div class="flex items-center space-x-2">
            <input
                type="checkbox"
                id="anonim"
                name="anonim"
                class="form-checkbox text-blue-600"
                value="1"  
            />
            <label for="anonim" class="text-gray-600">
                Ceklis untuk melapor sebagai Anonim
            </label>
        </div>



        <button
            type="submit"
            class="w-full px-8 py-4 text-lg font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-300 shadow-md transform hover:scale-105 text-center"
        >
            Lapor
        </button>
    </form>

    <div id="map" class="w-full h-96 mt-8"></div>
</main>

<!-- Google Maps API -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMap"></script>

<script>
    let map, marker;

    // Function to initialize the map
    function initMap() {
        // Lokasi default jika geolocation gagal
        const defaultLocation = { lat: -6.200000, lng: 106.816666 };

        // Inisialisasi peta
        map = new google.maps.Map(document.getElementById("map"), {
            center: defaultLocation,
            zoom: 15,
        });

        // Membuat marker yang bisa digeser
        marker = new google.maps.Marker({
            position: defaultLocation,
            map: map,
            draggable: true,
        });

        // Ketika marker digeser, update koordinat di form
        google.maps.event.addListener(marker, "dragend", function() {
            const position = marker.getPosition();
            document.getElementById("latitude").value = position.lat();
            document.getElementById("longitude").value = position.lng();
        });

        // Cek geolocation untuk mendapatkan lokasi pengguna
        getLocation();
    }

    // Fungsi untuk mendapatkan lokasi pengguna dan memperbarui peta
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                // Set lokasi peta dan marker berdasarkan lokasi pengguna
                const userLocation = { lat: latitude, lng: longitude };
                map.setCenter(userLocation);
                marker.setPosition(userLocation);

                // Update form fields dengan lokasi pengguna
                document.getElementById("latitude").value = latitude;
                document.getElementById("longitude").value = longitude;
            }, function(error) {
                // Tangani error jika lokasi tidak ditemukan
                alert("Lokasi tidak ditemukan. Peta diatur ke lokasi default.");
            });
        } else {
            alert("Geolocation tidak didukung oleh browser ini.");
        }
    }

    // Fungsi untuk membuka Google Maps dan memilih lokasi
    function openMap() {
        const lat = document.getElementById("latitude").value;
        const lng = document.getElementById("longitude").value;
        const url = `https://www.google.com/maps/?q=${lat},${lng}`;
        window.open(url, '_blank');
    }

    // Memastikan peta diinisialisasi saat halaman dimuat
    window.onload = function() {
        initMap();
    }
</script> 

@endsection

@extends('layouts.app-sidebar')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Pesan</h1>

    <div class="flex space-x-4 text-blue-600 mb-6">
        <a href="#" class="font-semibold tab border-b-2 border-blue-600">Semua</a>
        <a href="#" class="hover:underline tab">Belum di baca</a>
        <a href="#" class="hover:underline tab">Dibalas LaporBot</a>
        <a href="#" class="hover:underline tab">Tidak Dibalas LaporBot</a>
    </div>

    <div class="space-y-4">
        @foreach($messages as $message)
        <a href="{{ route('admin.message.detail', $message['id']) }}" class="block bg-white border border-blue-600 rounded-lg p-4 shadow-md hover:bg-blue-50">
            <div class="flex items-center justify-between">

                <div class="flex items-center">
                    <img src="{{ asset($message['photo']) }}" alt="Profile Picture" class="w-10 h-10 rounded-full mr-4">
                    <div>
                        <p class="text-sm font-semibold">{{ $message['name'] }} ~ {{ $message['email'] }}</p>
                        <p class="text-sm text-gray-600 truncate">{{ $message['content'] }}</p>
                    </div>
                </div>

                <div class="text-right">
                    <span class="block text-sm text-gray-500">{{ $message['time'] }}</span>
                    @if($message['unread'])
                        <div class="w-6 h-6 bg-blue-600 text-white text-sm font-semibold flex items-center justify-center rounded-full">
                            1
                        </div>
                    @endif
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection

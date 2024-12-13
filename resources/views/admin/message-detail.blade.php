@extends('layouts.app-sidebar')

@section('content')
<div class="container mx-auto p-6 max-w-[600px]">
    <div class="bg-white rounded-lg shadow-md border border-blue-600 overflow-hidden relative">

        <div class="bg-blue-100 p-6 border-b-2 border-blue-300">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <img src="{{ asset($message['photo']) }}" alt="Profile Picture" class="w-10 h-10 rounded-full mr-4 object-cover">
                    <h2 class="text-lg font-semibold text-gray-800">
                        {{ $message['name'] }}<br>
                        <span class="text-gray-600 text-sm">{{ $message['email'] }}</span>
                    </h2>
                </div>
                <i class="fas fa-times text-gray-500 cursor-pointer"></i>
            </div>
        </div>

        <div class="p-6 space-y-6">
            <p class="text-center text-gray-900 text-sm font-semibold">Hari Ini</p>
            @foreach($chats as $chat)
    @if ($chat['type'] === 'user')

        <div class="flex justify-start mb-4">
            <div class="max-w-xs bg-blue-100 text-gray-800 rounded-lg p-4 shadow">
                <p class="text-sm leading-relaxed">{{ $chat['message'] }}</p>
                <span class="text-xs text-gray-500 mt-2 block text-right">{{ $chat['time'] }}</span>
            </div>
        </div>
    @elseif ($chat['type'] === 'admin')

        <div class="flex justify-end mb-4">
            <div class="max-w-xs bg-gray-200 text-gray-800 rounded-lg p-4 shadow-lg border border-gray-300">
                <p class="text-sm leading-relaxed">{{ $chat['message'] }}</p>
                <span class="text-xs text-gray-500 mt-2 block text-right">{{ $chat['time'] }}</span>
            </div>
        </div>
    @endif
@endforeach

        </div>

        <div class="p-6 border-t">
            <div class="flex items-center">
                <button class="text-blue-600 mr-2">
                    <i class="far fa-smile"></i>
                </button>
                <input 
                    type="text" 
                    class="flex-grow border border-blue-600 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    placeholder="Ketik Pesan">
                <button class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

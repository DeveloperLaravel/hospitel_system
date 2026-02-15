<x-app-layout title="Room Details">

    <h1 class="text-2xl font-bold mb-4">Room #{{ $room->room_number }}</h1>

    <x-card>
        <x-slot name="title">Room Info</x-slot>
        <div class="grid grid-cols-2 gap-4">
            <div><strong>Room Number:</strong> {{ $room->room_number }}</div>
            <div><strong>Type:</strong> {{ ucfirst($room->type) }}</div>
            <div><strong>Status:</strong>
                <span class="{{ $room->status == 'available' ? 'text-green-600' : 'text-red-600' }}">
                    {{ ucfirst($room->status) }}
                </span>
            </div>
        </div>
    </x-card>

    <x-link href="{{ route('rooms.index') }}" class="mt-4 bg-gray-400 text-white inline-block">Back</x-link>

</x-app-layout>

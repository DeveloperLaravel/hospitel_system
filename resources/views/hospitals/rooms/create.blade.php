<x-app-layout title="{{ isset($room) ? 'Edit Room' : 'Add Room' }}">

    <h1 class="text-2xl font-bold mb-4">{{ isset($room) ? 'Edit Room' : 'Add Room' }}</h1>

    <x-validation-errors class="mb-4"/>

    <form action="{{ isset($room) ? route('rooms.update', $room) : route('rooms.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @if(isset($room)) @method('PUT') @endif

        <x-input label="Room Number" name="room_number" value="{{ old('room_number', $room->room_number ?? '') }}" required />

        <x-select label="Type" name="type" required>
            <option value="single" @selected(old('type', $room->type ?? '') == 'single')>Single</option>
            <option value="double" @selected(old('type', $room->type ?? '') == 'double')>Double</option>
            <option value="ICU" @selected(old('type', $room->type ?? '') == 'ICU')>ICU</option>
        </x-select>

        <x-select label="Status" name="status" required>
            <option value="available" @selected(old('status', $room->status ?? '') == 'available')>Available</option>
            <option value="occupied" @selected(old('status', $room->status ?? '') == 'occupied')>Occupied</option>
        </x-select>

        <div class="flex space-x-2 mt-4">
            <x-button type="submit" class="bg-blue-600 text-white">{{ isset($room) ? 'Update' : 'Save' }}</x-button>
            <a href="{{ route('rooms.index') }}" class="bg-gray-400 text-white">Cancel</a>
        </div>
    </form>

</x-app-layout>

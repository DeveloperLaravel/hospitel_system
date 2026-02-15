<x-app-layout title="Bed Assignment Details">

    <h1 class="text-2xl font-bold mb-4">Bed Assignment #{{ $bedAssignment->id }}</h1>

    <x-card>
        <x-slot name="title">Assignment Info</x-slot>
        <div class="grid grid-cols-2 gap-4">
            <div><strong>Patient:</strong> {{ $bedAssignment->patient->name }}</div>
            <div><strong>Room Number:</strong> {{ $bedAssignment->room->room_number }}</div>
            <div><strong>Type:</strong> {{ ucfirst($bedAssignment->room->type) }}</div>
            <div><strong>Status:</strong>
                <span class="{{ $bedAssignment->room->status == 'available' ? 'text-green-600' : 'text-red-600' }}">
                    {{ ucfirst($bedAssignment->room->status) }}
                </span>
            </div>
            <div><strong>Start Date:</strong> {{ $bedAssignment->start_date }}</div>
            <div><strong>End Date:</strong> {{ $bedAssignment->end_date ?? '-' }}</div>
        </div>
    </x-card>

    <x-link href="{{ route('bed_assignments.index') }}" class="mt-4 bg-gray-400 text-white inline-block">Back</x-link>

</x-app-layout>

<x-app-layout title="Nurse Details">

    <h1 class="text-2xl font-bold mb-4">Nurse #{{ $nurse->id }}</h1>

    <x-card>
        <x-slot name="title">Nurse Info</x-slot>
        <div class="grid grid-cols-2 gap-4">
            <div><strong>Name:</strong> {{ $nurse->name }}</div>
            <div><strong>Phone:</strong> {{ $nurse->phone ?? '-' }}</div>
            <div><strong>Department:</strong> {{ $nurse->department->name }}</div>
        </div>
    </x-card>

    <x-link href="{{ route('nurses.index') }}" class="mt-4 bg-gray-400 text-white inline-block">Back</x-link>

</x-app-layout>

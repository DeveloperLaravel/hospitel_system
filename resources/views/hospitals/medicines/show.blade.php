<x-app-layout title="Medicine Details">

    <h1 class="text-2xl font-bold mb-4">{{ $medicine->name }}</h1>

    <x-card>
        <x-slot name="title">Medicine Info</x-slot>
        <div class="grid grid-cols-2 gap-4">
            <div><strong>Name:</strong> {{ $medicine->name }}</div>
            <div><strong>Quantity:</strong> {{ $medicine->quantity }}</div>
            <div><strong>Price:</strong> ${{ $medicine->price }}</div>
            <div><strong>Expiry Date:</strong> {{ $medicine->expiry_date ?? '-' }}</div>
        </div>
    </x-card>

    <x-link href="{{ route('medicines.index') }}" class="mt-4 bg-gray-400 text-white inline-block">Back</x-link>

</x-app-layout>

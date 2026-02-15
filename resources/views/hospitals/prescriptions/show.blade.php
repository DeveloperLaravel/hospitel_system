<x-app-layout title="Prescription Details">

    <h1 class="text-2xl font-bold mb-4">Prescription #{{ $prescription->id }}</h1>

    <x-card>
        <x-slot name="title">Prescription Info</x-slot>
        <div class="grid grid-cols-2 gap-4">
            <div><strong>Patient:</strong> {{ $prescription->medicalRecord->patient->name }}</div>
            <div><strong>Medicine:</strong> {{ $prescription->medicine->name }}</div>
            <div><strong>Dosage:</strong> {{ $prescription->dosage ?? '-' }}</div>
            <div><strong>Duration:</strong> {{ $prescription->duration ?? '-' }}</div>
        </div>
    </x-card>

    <x-link href="{{ route('prescriptions.index') }}" class="mt-4 bg-gray-400 text-white inline-block">Back</x-link>

</x-app-layout>

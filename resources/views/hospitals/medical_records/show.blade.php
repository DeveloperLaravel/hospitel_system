<x-app-layout title="Medical Record Details">

    <h1 class="text-2xl font-bold mb-4">Medical Record #{{ $medicalRecord->id }}</h1>

    <x-card>
        <x-slot name="title">Record Info</x-slot>
        <div class="grid grid-cols-2 gap-4">
            <div><strong>Patient:</strong> {{ $medicalRecord->patient->name }}</div>
            <div><strong>Doctor:</strong> {{ $medicalRecord->doctor->name }}</div>
            <div><strong>Diagnosis:</strong> {{ $medicalRecord->diagnosis ?? '-' }}</div>
            <div><strong>Treatment:</strong> {{ $medicalRecord->treatment ?? '-' }}</div>
            <div class="col-span-2"><strong>Notes:</strong> {{ $medicalRecord->notes ?? '-' }}</div>
        </div>
    </x-card>

    <x-link href="{{ route('medical_records.index') }}" class="mt-4 bg-gray-400 text-white inline-block">Back</x-link>

</x-app-layout>

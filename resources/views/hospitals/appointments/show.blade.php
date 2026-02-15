<x-app-layout title="Appointment Details">

    <h1 class="text-2xl font-bold mb-4">Appointment #{{ $appointment->id }}</h1>

    <x-card>
        <x-slot name="title">Appointment Info</x-slot>
        <div class="grid grid-cols-2 gap-4">
            <div><strong>Patient:</strong> {{ $appointment->patient->name }}</div>
            <div><strong>Doctor:</strong> {{ $appointment->doctor->name }}</div>
            <div><strong>Date:</strong> {{ $appointment->date }}</div>
            <div><strong>Time:</strong> {{ $appointment->time }}</div>
            <div><strong>Status:</strong> {{ ucfirst($appointment->status) }}</div>
        </div>
    </x-card>

    <x-link href="{{ route('appointments.index') }}" class="mt-4 bg-gray-400 text-white inline-block">Back</x-link>

</x-app-layout>

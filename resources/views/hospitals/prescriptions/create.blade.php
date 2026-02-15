<x-app-layout title="{{ isset($prescription) ? 'Edit Prescription' : 'Add Prescription' }}">

    <h1 class="text-2xl font-bold mb-4">{{ isset($prescription) ? 'Edit Prescription' : 'Add Prescription' }}</h1>

    <x-validation-errors class="mb-4"/>

    <form action="{{ isset($prescription) ? route('prescriptions.update', $prescription) : route('prescriptions.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @if(isset($prescription)) @method('PUT') @endif

        <x-select label="Medical Record" name="medical_record_id" required>
            <option value="">Select Record</option>
            @foreach($medicalRecords as $record)
                <option value="{{ $record->id }}" @selected(old('medical_record_id', $prescription->medical_record_id ?? '') == $record->id)>
                    {{ $record->patient->name }} - #{{ $record->id }}
                </option>
            @endforeach
        </x-select>

        <x-select label="Medicine" name="medicine_id" required>
            <option value="">Select Medicine</option>
            @foreach($medicines as $medicine)
                <option value="{{ $medicine->id }}" @selected(old('medicine_id', $prescription->medicine_id ?? '') == $medicine->id)>
                    {{ $medicine->name }}
                </option>
            @endforeach
        </x-select>

        <x-input label="Dosage" name="dosage" value="{{ old('dosage', $prescription->dosage ?? '') }}" />
        <x-input label="Duration" name="duration" value="{{ old('duration', $prescription->duration ?? '') }}" />

        <div class="flex space-x-2">
            <x-button type="submit" class="bg-blue-600 text-white">{{ isset($prescription) ? 'Update' : 'Save' }}</x-button>
            <x-link href="{{ route('prescriptions.index') }}" class="bg-gray-400 text-white">Cancel</x-link>
        </div>
    </form>

</x-app-layout>

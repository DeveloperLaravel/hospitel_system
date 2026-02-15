<x-app-layout title="{{ isset($medicalRecord) ? 'Edit Record' : 'Add Medical Record' }}">

    <h1 class="text-2xl font-bold mb-4">{{ isset($medicalRecord) ? 'Edit Record' : 'Add Medical Record' }}</h1>

    <x-validation-errors class="mb-4"/>

    <form action="{{ isset($medicalRecord) ? route('medical_records.update', $medicalRecord) : route('medical_records.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @if(isset($medicalRecord)) @method('PUT') @endif

        <x-select label="Patient" name="patient_id" required>
            <option value="">Select Patient</option>
            @foreach($patients as $patient)
                <option value="{{ $patient->id }}" @selected(old('patient_id', $medicalRecord->patient_id ?? '') == $patient->id)>{{ $patient->name }}</option>
            @endforeach
        </x-select>

        <x-select label="Doctor" name="doctor_id" required>
            <option value="">Select Doctor</option>
            @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}" @selected(old('doctor_id', $medicalRecord->doctor_id ?? '') == $doctor->id)>{{ $doctor->name }}</option>
            @endforeach
        </x-select>

        <x-textarea label="Diagnosis" name="diagnosis">{{ old('diagnosis', $medicalRecord->diagnosis ?? '') }}</x-textarea>
        <x-textarea label="Treatment" name="treatment">{{ old('treatment', $medicalRecord->treatment ?? '') }}</x-textarea>
        <x-textarea label="Notes" name="notes">{{ old('notes', $medicalRecord->notes ?? '') }}</x-textarea>

        <div class="flex space-x-2">
            <x-button type="submit" class="bg-blue-600 text-white">{{ isset($medicalRecord) ? 'Update' : 'Save' }}</x-button>
            <x-link href="{{ route('medical_records.index') }}" class="bg-gray-400 text-white">Cancel</x-link>
        </div>
    </form>

</x-app-layout>

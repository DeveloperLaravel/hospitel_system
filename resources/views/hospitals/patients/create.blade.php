<x-app-layout title="{{ isset($patient) ? 'Edit Patient' : 'Add Patient' }}">

    <h1 class="text-2xl font-bold mb-4">{{ isset($patient) ? 'Edit Patient' : 'Add Patient' }}</h1>

    <x-validation-errors class="mb-4"/>

    <form action="{{ isset($patient) ? route('patients.update', $patient) : route('patients.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @if(isset($patient)) @method('PUT') @endif

        <x-input label="Name" name="name" value="{{ old('name', $patient->name ?? '') }}" required/>

        <x-input label="National ID" name="national_id" value="{{ old('national_id', $patient->national_id ?? '') }}"/>

        <x-input label="Age" name="age" type="number" value="{{ old('age', $patient->age ?? '') }}"/>

        <x-select label="Gender" name="gender">
            <option value="">Select Gender</option>
            <option value="male" @selected(old('gender', $patient->gender ?? '')=='male')>Male</option>
            <option value="female" @selected(old('gender', $patient->gender ?? '')=='female')>Female</option>
        </x-select>

        <x-input label="Phone" name="phone" value="{{ old('phone', $patient->phone ?? '') }}"/>

        <x-input label="Blood Type" name="blood_type" value="{{ old('blood_type', $patient->blood_type ?? '') }}"/>

        <x-textarea label="Address" name="address">{{ old('address', $patient->address ?? '') }}</x-textarea>

        <div class="flex space-x-2">
            <x-button type="submit" class="bg-blue-600 text-white">{{ isset($patient) ? 'Update' : 'Save' }}</x-button>
            <x-link href="{{ route('patients.index') }}" class="bg-gray-400 text-white">Cancel</x-link>
        </div>
    </form>

</x-app-layout>

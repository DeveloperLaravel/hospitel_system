<x-app-layout title="{{ isset($assignment) ? 'Edit Bed Assignment' : 'Assign Bed' }}">

    <h1 class="text-2xl font-bold mb-4">{{ isset($assignment) ? 'Edit Bed Assignment' : 'Assign Bed' }}</h1>

    <x-validation-errors class="mb-4"/>

    <form action="{{ isset($assignment) ? route('bed_assignments.update', $assignment) : route('bed_assignments.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @if(isset($assignment)) @method('PUT') @endif

        <x-select label="Patient" name="patient_id" required>
            <option value="">Select Patient</option>
            @foreach($patients as $patient)
                <option value="{{ $patient->id }}" @selected(old('patient_id', $assignment->patient_id ?? '') == $patient->id)>
                    {{ $patient->name }}
                </option>
            @endforeach
        </x-select>

        <x-select label="Room" name="room_id" required>
            <option value="">Select Room</option>
            @foreach($rooms as $room)
                <option value="{{ $room->id }}" @selected(old('room_id', $assignment->room_id ?? '') == $room->id)>
                    {{ $room->room_number }} ({{ ucfirst($room->type) }}) - {{ ucfirst($room->status) }}
                </option>
            @endforeach
        </x-select>

        <x-input label="Start Date" name="start_date" type="date" value="{{ old('start_date', $assignment->start_date ?? '') }}" required />
        <x-input label="End Date" name="end_date" type="date" value="{{ old('end_date', $assignment->end_date ?? '') }}" />

        <div class="flex space-x-2 mt-4">
            <x-button type="submit" class="bg-blue-600 text-white">{{ isset($assignment) ? 'Update' : 'Assign' }}</x-button>
            <x-link href="{{ route('bed_assignments.index') }}" class="bg-gray-400 text-white">Cancel</x-link>
        </div>
    </form>

</x-app-layout>

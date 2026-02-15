<x-app-layout title="{{ isset($appointment) ? 'Edit Appointment' : 'Add Appointment' }}">

    <h1 class="text-2xl font-bold mb-4">{{ isset($appointment) ? 'Edit Appointment' : 'Add Appointment' }}</h1>

    <x-validation-errors class="mb-4"/>

    <form action="{{ isset($appointment) ? route('appointments.update', $appointment) : route('appointments.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @if(isset($appointment)) @method('PUT') @endif

        <x-select label="Patient" name="patient_id" required>
            <option value="">Select Patient</option>
            @foreach($patients as $patient)
                <option value="{{ $patient->id }}" @selected(old('patient_id', $appointment->patient_id ?? '') == $patient->id)>{{ $patient->name }}</option>
            @endforeach
        </x-select>

        <x-select label="Doctor" name="doctor_id" required>
            <option value="">Select Doctor</option>
            @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}" @selected(old('doctor_id', $appointment->doctor_id ?? '') == $doctor->id)>{{ $doctor->name }}</option>
            @endforeach
        </x-select>

        <x-input label="Date" type="date" name="date" value="{{ old('date', $appointment->date ?? '') }}" required/>
        <x-input label="Time" type="time" name="time" value="{{ old('time', $appointment->time ?? '') }}" required/>

        <x-select label="Status" name="status" required>
            <option value="pending" @selected(old('status', $appointment->status ?? '')=='pending')>Pending</option>
            <option value="confirmed" @selected(old('status', $appointment->status ?? '')=='confirmed')>Confirmed</option>
            <option value="completed" @selected(old('status', $appointment->status ?? '')=='completed')>Completed</option>
            <option value="cancelled" @selected(old('status', $appointment->status ?? '')=='cancelled')>Cancelled</option>
        </x-select>

        <div class="flex space-x-2">
            <x-button type="submit" class="bg-blue-600 text-white">{{ isset($appointment) ? 'Update' : 'Save' }}</x-button>
            <x-link href="{{ route('appointments.index') }}" class="bg-gray-400 text-white">Cancel</x-link>
        </div>
    </form>

</x-app-layout>

@extends('layouts.app')

@section('title', isset($doctor) ? 'Edit Doctor' : 'Add Doctor')

@section('content')
<h1 class="text-2xl font-bold mb-4">{{ isset($doctor) ? 'Edit Doctor' : 'Add Doctor' }}</h1>

@if($errors->any())
    <div class="mb-4 p-2 bg-red-200 text-red-800 rounded">
        <ul>
            @foreach($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ isset($doctor) ? route('doctors.update', $doctor) : route('doctors.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
    @csrf
    @if(isset($doctor)) @method('PUT') @endif

    <div>
        <label class="block mb-1 font-semibold">Name</label>
        <input type="text" name="name" value="{{ old('name', $doctor->name ?? '') }}" class="w-full border p-2 rounded">
    </div>

    <div>
        <label class="block mb-1 font-semibold">Department</label>
        <select name="department_id" class="w-full border p-2 rounded">
            <option value="">Select Department</option>
            @foreach($departments as $dept)
                <option value="{{ $dept->id }}" @selected(old('department_id', $doctor->department_id ?? '') == $dept->id)>{{ $dept->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block mb-1 font-semibold">Specialization</label>
        <input type="text" name="specialization" value="{{ old('specialization', $doctor->specialization ?? '') }}" class="w-full border p-2 rounded">
    </div>

    <div>
        <label class="block mb-1 font-semibold">Phone</label>
        <input type="text" name="phone" value="{{ old('phone', $doctor->phone ?? '') }}" class="w-full border p-2 rounded">
    </div>

    <div>
        <label class="block mb-1 font-semibold">License Number</label>
        <input type="text" name="license_number" value="{{ old('license_number', $doctor->license_number ?? '') }}" class="w-full border p-2 rounded">
    </div>

    <div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">{{ isset($doctor) ? 'Update' : 'Save' }}</button>
        <a href="{{ route('doctors.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded">Cancel</a>
    </div>
</form>
@endsection

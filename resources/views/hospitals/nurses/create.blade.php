<x-app-layout title="{{ isset($nurse) ? 'Edit Nurse' : 'Add Nurse' }}">

    <h1 class="text-2xl font-bold mb-4">{{ isset($nurse) ? 'Edit Nurse' : 'Add Nurse' }}</h1>

    <x-validation-errors class="mb-4"/>

    <form action="{{ isset($nurse) ? route('nurses.update', $nurse) : route('nurses.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @if(isset($nurse)) @method('PUT') @endif

        <x-input label="Name" name="name" value="{{ old('name', $nurse->name ?? '') }}" required />
        <x-input label="Phone" name="phone" value="{{ old('phone', $nurse->phone ?? '') }}" />

        <x-select label="Department" name="department_id" required>
            <option value="">Select Department</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}" @selected(old('department_id', $nurse->department_id ?? '') == $department->id)>
                    {{ $department->name }}
                </option>
            @endforeach
        </x-select>

        <div class="flex space-x-2 mt-4">
            <x-button type="submit" class="bg-blue-600 text-white">{{ isset($nurse) ? 'Update' : 'Save' }}</x-button>
            <a href="{{ route('nurses.index') }}" class="bg-gray-400 text-white">Cancel</a>
        </div>
    </form>

</x-app-layout>

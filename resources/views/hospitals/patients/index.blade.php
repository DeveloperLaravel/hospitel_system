<x-app-layout >

    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Patients</h1>
        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'reception')
            <x-link href="{{ route('patients.create') }}" class="bg-blue-600 text-white">
                + Add Patient
            </x-link>
        @endif
    </div>

    @if(session('success'))
        <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <x-table>
        <x-slot name="head">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>National ID</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse($patients as $patient)
                <tr>
                    <td>{{ $patient->id }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->national_id }}</td>
                    <td>{{ $patient->age }}</td>
                    <td>{{ $patient->gender }}</td>
                    <td>{{ $patient->phone }}</td>
                    <td class="space-x-2">
                        <x-link href="{{ route('patients.show', $patient) }}" class="bg-green-400 text-white">
                            View
                        </x-link>
                        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'reception')
                            <x-link href="{{ route('patients.edit', $patient) }}" class="bg-yellow-400 text-white">
                                Edit
                            </x-link>
                            <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <x-button class="bg-red-500 text-white">Delete</x-button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center p-4">No patients found.</td>
                </tr>
            @endforelse
        </x-slot>
    </x-table>

    <div class="mt-4">
        {{ $patients->links() }}
    </div>

</x-app-layout>

<x-app-layout>

    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Medical Records</h1>
        @hasanyrole('admin|doctor')
            <x-link href="{{ route('medical_records.create') }}" class="bg-blue-600 text-white">
                + Add Record
            </x-link>
        @endhasanyrole
    </div>

    @if(session('success'))
        <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <x-table>
        <x-slot name="head">
            <tr>
                <th>#</th>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Diagnosis</th>
                <th>Actions</th>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse($records as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->patient->name }}</td>
                    <td>{{ $record->doctor->name }}</td>
                    <td>{{ Str::limit($record->diagnosis, 30) }}</td>
                    <td class="space-x-2">
                        <x-link href="{{ route('medical_records.show', $record) }}" class="bg-green-400 text-white">View</x-link>
                        @hasanyrole('admin|doctor')
                            <x-link href="{{ route('medical_records.edit', $record) }}" class="bg-yellow-400 text-white">Edit</x-link>
                            <form action="{{ route('medical_records.destroy', $record) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <x-button class="bg-red-500 text-white">Delete</x-button>
                            </form>
                        @endhasanyrole
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center p-4">No medical records found.</td>
                </tr>
            @endforelse
        </x-slot>
    </x-table>

    <div class="mt-4">
        {{ $records->links() }}
    </div>

</x-app-layout>

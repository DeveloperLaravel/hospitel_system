<x-app-layout title="Bed Assignments">

    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Bed Assignments</h1>
        @hasanyrole('admin|receptionist')
            <x-link href="{{ route('bed_assignments.create') }}" class="bg-blue-600 text-white">
                + Assign Bed
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
                <th>Room Number</th>
                <th>Type</th>
                <th>Status</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse($assignments as $assignment)
                <tr>
                    <td>{{ $assignment->id }}</td>
                    <td>{{ $assignment->patient->name }}</td>
                    <td>{{ $assignment->room->room_number }}</td>
                    <td>{{ ucfirst($assignment->room->type) }}</td>
                    <td>
                        <span class="{{ $assignment->room->status == 'available' ? 'text-green-600' : 'text-red-600' }}">
                            {{ ucfirst($assignment->room->status) }}
                        </span>
                    </td>
                    <td>{{ $assignment->start_date }}</td>
                    <td>{{ $assignment->end_date ?? '-' }}</td>
                    <td class="space-x-2">
                        <x-link href="{{ route('bed_assignments.show', $assignment) }}" class="bg-green-400 text-white">View</x-link>
                        @hasanyrole('admin|receptionist')
                            <x-link href="{{ route('bed_assignments.edit', $assignment) }}" class="bg-yellow-400 text-white">Edit</x-link>
                            <form action="{{ route('bed_assignments.destroy', $assignment) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <x-button class="bg-red-500 text-white">Delete</x-button>
                            </form>
                        @endhasanyrole
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center p-4">No bed assignments found.</td>
                </tr>
            @endforelse
        </x-slot>
    </x-table>

    <div class="mt-4">
        {{ $assignments->links() }}
    </div>

</x-app-layout>

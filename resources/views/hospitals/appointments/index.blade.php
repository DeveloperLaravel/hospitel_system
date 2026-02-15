<x-app-layout title="Appointments">

    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Appointments</h1>
        @hasanyrole('admin|reception')
            <a href="{{ route('appointments.create') }}" class="bg-blue-600 text-white">
                + Add Appointment
            </a>
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
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->id }}</td>
                    <td>{{ $appointment->patient->name }}</td>
                    <td>{{ $appointment->doctor->name }}</td>
                    <td>{{ $appointment->date }}</td>
                    <td>{{ $appointment->time }}</td>
                    <td>{{ ucfirst($appointment->status) }}</td>
                    <td class="space-x-2">
                        <a href="{{ route('appointments.show', $appointment) }}" class="bg-green-400 text-white">View</a>
                        @hasanyrole('admin|reception')
                            <a href="{{ route('appointments.edit', $appointment) }}" class="bg-yellow-400 text-white">Edit</a>
                            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <x-button class="bg-red-500 text-white">Delete</x-button>
                            </form>
                        @endhasanyrole
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center p-4">No appointments found.</td>
                </tr>
            @endforelse
        </x-slot>
    </x-table>

    <div class="mt-4">
        {{ $appointments->links() }}
    </div>

</x-app-layout>

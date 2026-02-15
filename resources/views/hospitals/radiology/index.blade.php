<x-app-layout title="Prescriptions">

    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Prescriptions</h1>
        @hasanyrole('admin|doctor|pharmacist')
            <x-link href="{{ route('prescriptions.create') }}" class="bg-blue-600 text-white">
                + Add Prescription
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
                <th>Medicine</th>
                <th>Dosage</th>
                <th>Duration</th>
                <th>Actions</th>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse($prescriptions as $prescription)
                <tr>
                    <td>{{ $prescription->id }}</td>
                    <td>{{ $prescription->medicalRecord->patient->name }}</td>
                    <td>{{ $prescription->medicine->name }}</td>
                    <td>{{ $prescription->dosage ?? '-' }}</td>
                    <td>{{ $prescription->duration ?? '-' }}</td>
                    <td class="space-x-2">
                        <x-link href="{{ route('prescriptions.show', $prescription) }}" class="bg-green-400 text-white">View</x-link>
                        @hasanyrole('admin|doctor|pharmacist')
                            <x-link href="{{ route('prescriptions.edit', $prescription) }}" class="bg-yellow-400 text-white">Edit</x-link>
                            <form action="{{ route('prescriptions.destroy', $prescription) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <x-button class="bg-red-500 text-white">Delete</x-button>
                            </form>
                        @endhasanyrole
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center p-4">No prescriptions found.</td>
                </tr>
            @endforelse
        </x-slot>
    </x-table>

    <div class="mt-4">
        {{-- {{ $prescriptions->links() }} --}}
            {{-- {{ $doctors->links() }} <!-- هذا يعمل الآن --> --}}

    </div>

</x-app-layout>

<x-app-layout title="Medicines">

    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Medicines</h1>
        @hasanyrole('admin|pharmacist')
            <x-link href="{{ route('medicines.create') }}" class="bg-blue-600 text-white">
                + Add Medicine
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
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Expiry Date</th>
                <th>Actions</th>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse($medicines as $medicine)
                <tr>
                    <td>{{ $medicine->id }}</td>
                    <td>{{ $medicine->name }}</td>
                    <td>{{ $medicine->quantity }}</td>
                    <td>${{ $medicine->price }}</td>
                    <td>{{ $medicine->expiry_date ?? '-' }}</td>
                    <td class="space-x-2">
                        <x-link href="{{ route('medicines.show', $medicine) }}" class="bg-green-400 text-white">View</x-link>
                        @hasanyrole('admin|pharmacist')
                            <x-link href="{{ route('medicines.edit', $medicine) }}" class="bg-yellow-400 text-white">Edit</x-link>
                            <form action="{{ route('medicines.destroy', $medicine) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <x-button class="bg-red-500 text-white">Delete</x-button>
                            </form>
                        @endhasanyrole
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center p-4">No medicines found.</td>
                </tr>
            @endforelse
        </x-slot>
    </x-table>

    <div class="mt-4">
        {{ $medicines->links() }}
    </div>

</x-app-layout>

<x-app-layout title="Invoice Items">

    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Invoice Items</h1>
        @hasanyrole('admin|accountant')
            <x-link href="{{ route('invoice_items.create') }}" class="bg-blue-600 text-white">
                + Add Item
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
                <th>Invoice #</th>
                <th>Patient</th>
                <th>Service</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->invoice->id }}</td>
                    <td>{{ $item->invoice->patient->name }}</td>
                    <td>{{ $item->service }}</td>
                    <td>${{ $item->price }}</td>
                    <td class="space-x-2">
                        <x-link href="{{ route('invoice_items.show', $item) }}" class="bg-green-400 text-white">View</x-link>
                        @hasanyrole('admin|accountant')
                            <x-link href="{{ route('invoice_items.edit', $item) }}" class="bg-yellow-400 text-white">Edit</x-link>
                            <form action="{{ route('invoice_items.destroy', $item) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <x-button class="bg-red-500 text-white">Delete</x-button>
                            </form>
                        @endhasanyrole
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center p-4">No invoice items found.</td>
                </tr>
            @endforelse
        </x-slot>
    </x-table>

    <div class="mt-4">
        {{ $items->links() }}
    </div>

</x-app-layout>

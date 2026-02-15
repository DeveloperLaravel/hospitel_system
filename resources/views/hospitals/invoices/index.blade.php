<x-app-layout title="Invoices">

    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Invoices</h1>
        @hasanyrole('admin|accountant')
            <x-link href="{{ route('invoices.create') }}" class="bg-blue-600 text-white">
                + Add Invoice
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
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->patient->name }}</td>
                    <td>${{ $invoice->total }}</td>
                    <td>{{ ucfirst($invoice->status) }}</td>
                    <td class="space-x-2">
                        <x-link href="{{ route('invoices.show', $invoice) }}" class="bg-green-400 text-white">View</x-link>
                        @hasanyrole('admin|accountant')
                            <x-link href="{{ route('invoices.edit', $invoice) }}" class="bg-yellow-400 text-white">Edit</x-link>
                            <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <x-button class="bg-red-500 text-white">Delete</x-button>
                            </form>
                        @endhasanyrole
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center p-4">No invoices found.</td>
                </tr>
            @endforelse
        </x-slot>
    </x-table>

    <div class="mt-4">
        {{ $invoices->links() }}
    </div>

</x-app-layout>

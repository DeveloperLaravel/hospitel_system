<x-app-layout title="Invoice Details">

    <h1 class="text-2xl font-bold mb-4">Invoice #{{ $invoice->id }}</h1>

    <x-card>
        <x-slot name="title">Invoice Info</x-slot>
        <div class="grid grid-cols-2 gap-4">
            <div><strong>Patient:</strong> {{ $invoice->patient->name }}</div>
            <div><strong>Status:</strong> {{ ucfirst($invoice->status) }}</div>
            <div><strong>Total:</strong> ${{ $invoice->total }}</div>
        </div>
    </x-card>

    <x-card class="mt-4">
        <x-slot name="title">Medicines</x-slot>
        <table class="w-full text-left">
            <thead>
                <tr>
                    <th>Medicine</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->medicines as $medicine)
                    <tr>
                        <td>{{ $medicine->name }}</td>
                        <td>{{ $medicine->pivot->quantity }}</td>
                        <td>${{ $medicine->pivot->price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-card>

    <x-link href="{{ route('invoices.index') }}" class="mt-4 bg-gray-400 text-white inline-block">Back</x-link>

</x-app-layout>

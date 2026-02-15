<x-app-layout title="Invoice Item Details">

    <h1 class="text-2xl font-bold mb-4">Invoice Item #{{ $invoiceItem->id }}</h1>

    <x-card>
        <x-slot name="title">Invoice Item Info</x-slot>
        <div class="grid grid-cols-2 gap-4">
            <div><strong>Invoice #:</strong> {{ $invoiceItem->invoice->id }}</div>
            <div><strong>Patient:</strong> {{ $invoiceItem->invoice->patient->name }}</div>
            <div><strong>Service:</strong> {{ $invoiceItem->service }}</div>
            <div><strong>Price:</strong> ${{ $invoiceItem->price }}</div>
        </div>
    </x-card>

    <x-link href="{{ route('invoice_items.index') }}" class="mt-4 bg-gray-400 text-white inline-block">Back</x-link>

</x-app-layout>

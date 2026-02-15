<x-app-layout title="{{ isset($item) ? 'Edit Invoice Item' : 'Add Invoice Item' }}">

    <h1 class="text-2xl font-bold mb-4">{{ isset($item) ? 'Edit Invoice Item' : 'Add Invoice Item' }}</h1>

    <x-validation-errors class="mb-4"/>

    <form action="{{ isset($item) ? route('invoice_items.update', $item) : route('invoice_items.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @if(isset($item)) @method('PUT') @endif

        <x-select label="Invoice" name="invoice_id" required>
            <option value="">Select Invoice</option>
            @foreach($invoices as $invoice)
                <option value="{{ $invoice->id }}" @selected(old('invoice_id', $item->invoice_id ?? '') == $invoice->id)>
                    #{{ $invoice->id }} - {{ $invoice->patient->name }}
                </option>
            @endforeach
        </x-select>

        <x-input label="Service" name="service" value="{{ old('service', $item->service ?? '') }}" required />
        <x-input label="Price" name="price" type="number" step="0.01" value="{{ old('price', $item->price ?? 0) }}" required />

        <div class="flex space-x-2 mt-4">
            <x-button type="submit" class="bg-blue-600 text-white">{{ isset($item) ? 'Update' : 'Save' }}</x-button>
            <x-link href="{{ route('invoice_items.index') }}" class="bg-gray-400 text-white">Cancel</x-link>
        </div>
    </form>

</x-app-layout>

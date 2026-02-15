<x-app-layout title="{{ isset($medicine) ? 'Edit Medicine' : 'Add Medicine' }}">

    <h1 class="text-2xl font-bold mb-4">{{ isset($medicine) ? 'Edit Medicine' : 'Add Medicine' }}</h1>

    <x-validation-errors class="mb-4"/>

    <form action="{{ isset($medicine) ? route('medicines.update', $medicine) : route('medicines.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @if(isset($medicine)) @method('PUT') @endif

        <x-input label="Name" name="name" value="{{ old('name', $medicine->name ?? '') }}" required/>
        <x-input label="Quantity" name="quantity" type="number" value="{{ old('quantity', $medicine->quantity ?? 0) }}" min="0"/>
        <x-input label="Price" name="price" type="number" step="0.01" value="{{ old('price', $medicine->price ?? 0) }}" min="0"/>
        <x-input label="Expiry Date" name="expiry_date" type="date" value="{{ old('expiry_date', $medicine->expiry_date ?? '') }}"/>

        <div class="flex space-x-2">
            <x-button type="submit" class="bg-blue-600 text-white">{{ isset($medicine) ? 'Update' : 'Save' }}</x-button>
            <x-link href="{{ route('medicines.index') }}" class="bg-gray-400 text-white">Cancel</x-link>
        </div>
    </form>

</x-app-layout>

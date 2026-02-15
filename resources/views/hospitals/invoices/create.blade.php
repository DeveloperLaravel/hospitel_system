<x-app-layout title="{{ isset($invoice) ? 'Edit Invoice' : 'Add Invoice' }}">

    <h1 class="text-2xl font-bold mb-4">{{ isset($invoice) ? 'Edit Invoice' : 'Add Invoice' }}</h1>

    <x-validation-errors class="mb-4"/>

    <form action="{{ isset($invoice) ? route('invoices.update', $invoice) : route('invoices.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @if(isset($invoice)) @method('PUT') @endif

        <x-select label="Patient" name="patient_id" required>
            <option value="">Select Patient</option>
            @foreach($patients as $patient)
                <option value="{{ $patient->id }}" @selected(old('patient_id', $invoice->patient_id ?? '') == $patient->id)>{{ $patient->name }}</option>
            @endforeach
        </x-select>

        <x-select label="Status" name="status" required>
            <option value="unpaid" @selected(old('status', $invoice->status ?? '') == 'unpaid')>Unpaid</option>
            <option value="paid" @selected(old('status', $invoice->status ?? '') == 'paid')>Paid</option>
        </x-select>

        <div>
            <label class="block mb-1 font-semibold">Medicines</label>
            <div id="medicine-list" class="space-y-2">
                @if(old('medicines'))
                    @foreach(old('medicines') as $i => $medId)
                        <div class="flex space-x-2">
                            <select name="medicines[]" class="border rounded p-2">
                                <option value="">Select Medicine</option>
                                @foreach($medicines as $medicine)
                                    <option value="{{ $medicine->id }}" @selected($medicine->id == $medId)>{{ $medicine->name }}</option>
                                @endforeach
                            </select>
                            <input type="number" name="quantities[]" value="{{ old('quantities')[$i] ?? 1 }}" min="1" class="border rounded p-2 w-20" placeholder="Qty">
                        </div>
                    @endforeach
                @else
                    <div class="flex space-x-2">
                        <select name="medicines[]" class="border rounded p-2">
                            <option value="">Select Medicine</option>
                            @foreach($medicines as $medicine)
                                <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="quantities[]" value="1" min="1" class="border rounded p-2 w-20" placeholder="Qty">
                    </div>
                @endif
            </div>
            <button type="button" onclick="addMedicine()" class="mt-2 bg-gray-200 px-3 py-1 rounded">+ Add Medicine</button>
        </div>

        <div class="flex space-x-2 mt-4">
            <x-button type="submit" class="bg-blue-600 text-white">{{ isset($invoice) ? 'Update' : 'Save' }}</x-button>
            <x-link href="{{ route('invoices.index') }}" class="bg-gray-400 text-white">Cancel</x-link>
        </div>
    </form>

    <script>
        const medicines = @json($medicines);
        function addMedicine() {
            const container = document.getElementById('medicine-list');
            const div = document.createElement('div');
            div.classList.add('flex','space-x-2','mt-2');
            div.innerHTML = `
                <select name="medicines[]" class="border rounded p-2">
                    <option value="">Select Medicine</option>
                    ${medicines.map(m => `<option value="${m.id}">${m.name}</option>`).join('')}
                </select>
                <input type="number" name="quantities[]" value="1" min="1" class="border rounded p-2 w-20" placeholder="Qty">
            `;
            container.appendChild(div);
        }
    </script>

</x-app-layout>

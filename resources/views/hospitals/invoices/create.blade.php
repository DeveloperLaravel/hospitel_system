<x-app-layout title="{{ isset($invoice) ? 'Edit Invoice' : 'Add Invoice' }}">

    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">

        {{-- العنوان --}}
        <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">
            {{ isset($invoice) ? 'Edit Invoice' : 'Add Invoice' }}
        </h1>

        {{-- عرض الأخطاء --}}
        <x-validation-errors class="mb-4"/>

        <form action="{{ isset($invoice) ? route('invoices.update', $invoice) : route('invoices.store') }}"
              method="POST"
              class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg transition-colors">

            @csrf
            @if(isset($invoice)) @method('PUT') @endif

            {{-- اختيار المريض --}}
            <x-select label="Patient" name="patient_id" required
                      :disabled="!auth()->user()->can('invoice.create') && !auth()->user()->can('invoice.edit')"
                      class="dark:bg-gray-700 dark:text-gray-100">
                <option value="">Select Patient</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}"
                        @selected(old('patient_id', $invoice->patient_id ?? '') == $patient->id)>
                        {{ $patient->name }}
                    </option>
                @endforeach
            </x-select>

            {{-- حالة الفاتورة --}}
            <x-select label="Status" name="status" required
                      :disabled="!auth()->user()->can('invoice.create') && !auth()->user()->can('invoice.edit')"
                      class="dark:bg-gray-700 dark:text-gray-100">
                <option value="unpaid" @selected(old('status', $invoice->status ?? '') == 'unpaid')>Unpaid</option>
                <option value="paid" @selected(old('status', $invoice->status ?? '') == 'paid')>Paid</option>
            </x-select>

            {{-- قائمة الأدوية --}}
            <div>
                <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">Medicines</label>
                <div id="medicine-list" class="space-y-2">

                    @php
                        $oldMedicines = old('medicines', $invoice->medicines->pluck('id')->toArray() ?? []);
                        $oldQuantities = old('quantities', $invoice->medicines->pluck('pivot.quantity')->toArray() ?? []);
                    @endphp

                    @if($oldMedicines)
                        @foreach($oldMedicines as $i => $medId)
                            <div class="flex flex-col sm:flex-row gap-2 items-center">
                                <select name="medicines[]" class="border rounded p-2 flex-1 dark:bg-gray-700 dark:text-gray-100">
                                    <option value="">Select Medicine</option>
                                    @foreach($medicines as $medicine)
                                        <option value="{{ $medicine->id }}" @selected($medicine->id == $medId)>{{ $medicine->name }}</option>
                                    @endforeach
                                </select>
                                <input type="number" name="quantities[]" value="{{ $oldQuantities[$i] ?? 1 }}" min="1" class="border rounded p-2 w-24" placeholder="Qty">
                                <button type="button" onclick="this.parentElement.remove()" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition">X</button>
                            </div>
                        @endforeach
                    @else
                        <div class="flex flex-col sm:flex-row gap-2 items-center">
                            <select name="medicines[]" class="border rounded p-2 flex-1 dark:bg-gray-700 dark:text-gray-100">
                                <option value="">Select Medicine</option>
                                @foreach($medicines as $medicine)
                                    <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                                @endforeach
                            </select>
                            <input type="number" name="quantities[]" value="1" min="1" class="border rounded p-2 w-24" placeholder="Qty">
                            <button type="button" onclick="this.parentElement.remove()" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition">X</button>
                        </div>
                    @endif

                </div>
                @canany(['invoice.create', 'invoice.edit'])
                <button type="button" onclick="addMedicine()" class="mt-2 bg-gray-200 dark:bg-gray-700 dark:text-gray-100 px-3 py-1 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    + Add Medicine
                </button>
                @endcanany
            </div>

            {{-- أزرار حفظ وإلغاء --}}
            <div class="flex flex-col sm:flex-row gap-3 mt-4">
                @canany(['invoice.create', 'invoice.edit'])
                    <x-button type="submit" class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white px-5 py-2 rounded-lg transition">
                        {{ isset($invoice) ? 'Update' : 'Save' }}
                    </x-button>
                @endcanany

                <a href="{{ route('invoices.index') }}"
                   class="bg-gray-400 hover:bg-gray-500 dark:bg-gray-600 dark:hover:bg-gray-500 text-white px-5 py-2 rounded-lg transition">
                    Cancel
                </a>
            </div>

        </form>
    </div>

    {{-- سكربت إضافة دواء --}}
    <script>
        const medicines = @json($medicines);
        function addMedicine() {
            const container = document.getElementById('medicine-list');
            const div = document.createElement('div');
            div.classList.add('flex','flex-col','sm:flex-row','gap-2','items-center','mt-2');
            div.innerHTML = `
                <select name="medicines[]" class="border rounded p-2 flex-1 dark:bg-gray-700 dark:text-gray-100">
                    <option value="">Select Medicine</option>
                    ${medicines.map(m => `<option value="${m.id}">${m.name}</option>`).join('')}
                </select>
                <input type="number" name="quantities[]" value="1" min="1" class="border rounded p-2 w-24" placeholder="Qty">
                <button type="button" onclick="this.parentElement.remove()" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition">X</button>
            `;
            container.appendChild(div);
        }
    </script>

</x-app-layout>

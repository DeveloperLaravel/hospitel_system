<x-app-layout>
        <div class="flex flex-col sm:flex-row justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                {{ isset($medicine) ? 'تعديل الدواء' : 'إضافة دواء جديد' }}
            </h1>
            @can('medicines.create')
                <a href="{{ route('medicines.create') }}"
                   class="mt-2 sm:mt-0 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    ➕ إضافة دواء
                </a>
            @endcan
        </div>

    <div class="py-6 max-w-3xl mx-auto">

        {{-- عرض الأخطاء --}}
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-200 text-red-800 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($medicine) ? route('medicines.update', $medicine) : route('medicines.store') }}"
              method="POST"
              class="space-y-6 bg-white p-6 rounded shadow-md">

            @csrf
            @if(isset($medicine)) @method('PUT') @endif

            {{-- الاسم والكمية والسعر --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">اسم الدواء</label>
                    <input type="text" name="name" value="{{ old('name', $medicine->name ?? '') }}" required
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block mb-1 font-semibold">الكمية</label>
                    <input type="number" name="quantity" min="0" value="{{ old('quantity', $medicine->quantity ?? 0) }}"
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block mb-1 font-semibold">السعر</label>
                    <input type="number" name="price" step="0.01" min="0" value="{{ old('price', $medicine->price ?? 0) }}"
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block mb-1 font-semibold">تاريخ الانتهاء</label>
                    <input type="date" name="expiry_date" value="{{ old('expiry_date', $medicine->expiry_date ?? '') }}"
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            {{-- الأزرار --}}
            <div class="flex flex-col sm:flex-row gap-2 mt-4">
                @canany(['medicines.create','medicines.edit'])
                    <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        {{ isset($medicine) ? 'تحديث' : 'حفظ' }}
                    </button>
                @endcanany
                <a href="{{ route('medicines.index') }}"
                   class="px-6 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 text-center">
                    إلغاء
                </a>
            </div>

        </form>
    </div>
</x-app-layout>

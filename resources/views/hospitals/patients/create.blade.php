<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            {{ isset($patient) ? 'تعديل بيانات المريض' : 'إضافة مريض جديد' }}
        </h1>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
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

        <form action="{{ isset($patient) ? route('patients.update', $patient) : route('patients.store') }}"
              method="POST"
              class="space-y-6 bg-white p-6 rounded shadow-md">

            @csrf
            @if(isset($patient)) @method('PUT') @endif

            {{-- الاسم والهويات --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">الاسم</label>
                    <input type="text" name="name" value="{{ old('name', $patient->name ?? '') }}"
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400" required>
                </div>

                <div>
                    <label class="block mb-1 font-semibold">رقم الهوية</label>
                    <input type="text" name="national_id" value="{{ old('national_id', $patient->national_id ?? '') }}"
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            {{-- العمر والجنس --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">العمر</label>
                    <input type="number" name="age" value="{{ old('age', $patient->age ?? '') }}"
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block mb-1 font-semibold">الجنس</label>
                    <select name="gender" class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400">
                        <option value="">اختر الجنس</option>
                        <option value="male" @selected(old('gender', $patient->gender ?? '')=='male')>ذكر</option>
                        <option value="female" @selected(old('gender', $patient->gender ?? '')=='female')>أنثى</option>
                    </select>
                </div>
            </div>

            {{-- الهاتف وفصيلة الدم --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">الهاتف</label>
                    <input type="text" name="phone" value="{{ old('phone', $patient->phone ?? '') }}"
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block mb-1 font-semibold">فصيلة الدم</label>
                    <input type="text" name="blood_type" value="{{ old('blood_type', $patient->blood_type ?? '') }}"
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            {{-- العنوان --}}
            <div>
                <label class="block mb-1 font-semibold">العنوان</label>
                <textarea name="address" rows="4"
                          class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400">{{ old('address', $patient->address ?? '') }}</textarea>
            </div>

            {{-- الأزرار --}}
            <div class="flex flex-col sm:flex-row gap-2">
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    {{ isset($patient) ? 'تحديث' : 'حفظ' }}
                </button>
                <a href="{{ route('patients.index') }}"
                   class="px-6 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 transition text-center">
                    إلغاء
                </a>
            </div>

        </form>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            {{ isset($doctor) ? 'تعديل بيانات الطبيب' : 'إضافة طبيب جديد' }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        @if($errors->any())
            <div class="mb-4 p-3 bg-red-200 text-red-800 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($doctor) ? route('doctors.update', $doctor) : route('doctors.store') }}"
              method="POST"
              class="space-y-4 bg-white p-6 rounded shadow">

            @csrf
            @if(isset($doctor)) @method('PUT') @endif

            <div>
                <label class="block mb-1 font-semibold">الاسم</label>
                <input type="text" name="name" value="{{ old('name', $doctor->name ?? '') }}"
                       class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">القسم</label>
                <select name="department_id" class="w-full border p-2 rounded" required>
                    <option value="">اختر القسم</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}"
                            @selected(old('department_id', $doctor->department_id ?? '') == $dept->id)>
                            {{ $dept->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-semibold">التخصص</label>
                <input type="text" name="specialization" value="{{ old('specialization', $doctor->specialization ?? '') }}"
                       class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">الهاتف</label>
                <input type="text" name="phone" value="{{ old('phone', $doctor->phone ?? '') }}"
                       class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">رقم الترخيص</label>
                <input type="text" name="license_number" value="{{ old('license_number', $doctor->license_number ?? '') }}"
                       class="w-full border p-2 rounded" required>
            </div>

            <div class="flex space-x-2">
                {{-- زر الحفظ يظهر فقط لمن يملك صلاحية doctors.create أو doctors.edit --}}
                @if(isset($doctor))
                    @can('doctors.edit')
                        <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                            تحديث
                        </button>
                    @endcan
                @else
                    @can('doctors.create')
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            حفظ
                        </button>
                    @endcan
                @endif

                <a href="{{ route('doctors.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 transition">
                    إلغاء
                </a>
            </div>
        </form>
    </div>
</x-app-layout>

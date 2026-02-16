<x-app-layout title="{{ isset($labTest) ? 'تعديل التحليل' : 'إضافة تحليل جديد' }}">

    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">

        {{-- العنوان --}}
        <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">
            {{ isset($labTest) ? 'تعديل التحليل' : 'إضافة تحليل جديد' }}
        </h1>

        {{-- عرض أخطاء التحقق --}}
        <x-validation-errors class="mb-4"/>

        <form action="{{ isset($labTest) ? route('lab_tests.update', $labTest) : route('lab_tests.store') }}"
              method="POST"
              class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg transition-colors">

            @csrf
            @if(isset($labTest)) @method('PUT') @endif

            {{-- اختيار المريض والطبيب --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @hasanyrole('admin|lab_tech')
                    <x-select label="المريض" name="patient_id" required class="dark:bg-gray-700 dark:text-gray-100">
                        <option value="">اختر المريض</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}"
                                @selected(old('patient_id', $labTest->patient_id ?? '') == $patient->id)>
                                {{ $patient->name }}
                            </option>
                        @endforeach
                    </x-select>

                    <x-select label="الطبيب" name="doctor_id" required class="dark:bg-gray-700 dark:text-gray-100">
                        <option value="">اختر الطبيب</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}"
                                @selected(old('doctor_id', $labTest->doctor_id ?? '') == $doctor->id)>
                                {{ $doctor->name }}
                            </option>
                        @endforeach
                    </x-select>
                @else
                    {{-- عرض البيانات فقط لغير الصلاحية --}}
                    <x-input label="المريض" name="patient_name" value="{{ $labTest->patient->name ?? '' }}" disabled class="dark:bg-gray-700 dark:text-gray-100"/>
                    <x-input label="الطبيب" name="doctor_name" value="{{ $labTest->doctor->name ?? '' }}" disabled class="dark:bg-gray-700 dark:text-gray-100"/>
                @endhasanyrole
            </div>

            {{-- اسم التحليل --}}
            <x-input label="اسم التحليل" name="test_name"
                     value="{{ old('test_name', $labTest->test_name ?? '') }}"
                     required
                     :disabled="!auth()->user()->hasAnyRole(['admin','lab_tech'])"
                     class="dark:bg-gray-700 dark:text-gray-100"/>

            {{-- النتيجة --}}
            <x-textarea label="النتيجة" name="result"
                        :disabled="!auth()->user()->hasAnyRole(['admin','lab_tech'])">
                {{ old('result', $labTest->result ?? '') }}
            </x-textarea>

            {{-- الحالة --}}
            <x-select label="الحالة" name="status" required
                      :disabled="!auth()->user()->hasAnyRole(['admin','lab_tech'])"
                      class="dark:bg-gray-700 dark:text-gray-100">
                <option value="pending" @selected(old('status', $labTest->status ?? '') == 'pending')>معلق</option>
                <option value="completed" @selected(old('status', $labTest->status ?? '') == 'completed')>مكتمل</option>
            </x-select>

            {{-- أزرار حفظ وإلغاء --}}
            <div class="flex flex-col sm:flex-row gap-3 mt-4">
                @hasanyrole('admin|lab_tech')
                    <x-button type="submit" class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white px-5 py-2 rounded-lg transition">
                        {{ isset($labTest) ? 'تحديث' : 'حفظ' }}
                    </x-button>
                @endhasanyrole

                <a href="{{ route('lab_tests.index') }}"
                   class="bg-gray-400 hover:bg-gray-500 dark:bg-gray-600 dark:hover:bg-gray-500 text-white px-5 py-2 rounded-lg transition">
                    إلغاء
                </a>
            </div>

        </form>
    </div>

</x-app-layout>

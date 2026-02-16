<x-app-layout title="{{ isset($medicalRecord) ? 'تعديل السجل الطبي' : 'إضافة سجل طبي' }}">

    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">

        {{-- العنوان --}}
        <h1 class="text-3xl font-bold mb-6
                   text-gray-800 dark:text-gray-100">
            {{ isset($medicalRecord) ? 'تعديل السجل الطبي' : 'إضافة سجل طبي' }}
        </h1>

        {{-- عرض أخطاء التحقق --}}
        <x-validation-errors class="mb-4"/>

        <form action="{{ isset($medicalRecord) ? route('medical_records.update', $medicalRecord) : route('medical_records.store') }}"
              method="POST"
              class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg transition-colors duration-300">

            @csrf
            @if(isset($medicalRecord)) @method('PUT') @endif

            {{-- اختيار المريض والطبيب --}}
            @hasanyrole('admin|doctor')
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-select label="المريض" name="patient_id" required class="dark:bg-gray-700 dark:text-gray-100">
                    <option value="">اختر المريض</option>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}"
                            @selected(old('patient_id', $medicalRecord->patient_id ?? '') == $patient->id)>
                            {{ $patient->name }}
                        </option>
                    @endforeach
                </x-select>

                <x-select label="الطبيب" name="doctor_id" required class="dark:bg-gray-700 dark:text-gray-100">
                    <option value="">اختر الطبيب</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}"
                            @selected(old('doctor_id', $medicalRecord->doctor_id ?? '') == $doctor->id)>
                            {{ $doctor->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-input label="المريض" name="patient_name" value="{{ $medicalRecord->patient->name ?? '' }}" disabled class="dark:bg-gray-700 dark:text-gray-100"/>
                    <x-input label="الطبيب" name="doctor_name" value="{{ $medicalRecord->doctor->name ?? '' }}" disabled class="dark:bg-gray-700 dark:text-gray-100"/>
                </div>
            @endhasanyrole

            {{-- التشخيص --}}
            <x-textarea label="التشخيص" name="diagnosis" required
                        :disabled="!auth()->user()->hasAnyRole(['admin','doctor'])"
                        class="dark:bg-gray-700 dark:text-gray-100 dark:placeholder-gray-400">
                {{ old('diagnosis', $medicalRecord->diagnosis ?? '') }}
            </x-textarea>

            {{-- العلاج --}}
            <x-textarea label="العلاج" name="treatment"
                        :disabled="!auth()->user()->hasAnyRole(['admin','doctor'])"
                        class="dark:bg-gray-700 dark:text-gray-100 dark:placeholder-gray-400">
                {{ old('treatment', $medicalRecord->treatment ?? '') }}
            </x-textarea>

            {{-- ملاحظات إضافية --}}
            <x-textarea label="ملاحظات" name="notes"
                        :disabled="!auth()->user()->hasAnyRole(['admin','doctor'])"
                        class="dark:bg-gray-700 dark:text-gray-100 dark:placeholder-gray-400">
                {{ old('notes', $medicalRecord->notes ?? '') }}
            </x-textarea>

            {{-- أزرار حفظ وإلغاء --}}
            <div class="flex flex-col sm:flex-row justify-start items-start sm:items-center gap-3 mt-4">
                @hasanyrole('admin|doctor')
                    <x-button type="submit"
                              class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white px-5 py-2 rounded-lg transition">
                        {{ isset($medicalRecord) ? 'تحديث' : 'حفظ' }}
                    </x-button>
                @endhasanyrole
                <a href="{{ route('medical_records.index') }}"
                   class="bg-gray-400 hover:bg-gray-500 dark:bg-gray-600 dark:hover:bg-gray-500 text-white px-5 py-2 rounded-lg transition">
                    إلغاء
                </a>
            </div>

        </form>
    </div>

</x-app-layout>

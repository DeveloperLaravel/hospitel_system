<x-app-layout>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            {{ isset($appointment) ? 'تعديل الموعد' : 'إضافة موعد جديد' }}
        </h1>

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

        <form action="{{ isset($appointment) ? route('appointments.update', $appointment) : route('appointments.store') }}"
              method="POST"
              class="space-y-6 bg-white p-6 rounded shadow-md">

            @csrf
            @if(isset($appointment)) @method('PUT') @endif

       {{--  --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">المريض</label>
                    <select name="patient_id" required
                            class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400">
                        <option value="">اختر المريض</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}"
                                @selected(old('patient_id', $appointment->patient_id ?? '') == $patient->id)>
                                {{ $patient->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-semibold">الطبيب</label>
                    <select name="doctor_id" required
                            class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400">
                        <option value="">اختر الطبيب</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}"
                                @selected(old('doctor_id', $appointment->doctor_id ?? '') == $doctor->id)>
                                {{ $doctor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- التاريخ والوقت --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">التاريخ</label>
                    <input type="date" name="date" value="{{ old('date', $appointment->date ?? '') }}" required
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block mb-1 font-semibold">الوقت</label>
                    <input type="time" name="time" value="{{ old('time', $appointment->time ?? '') }}" required
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            {{-- الحالة --}}
            <div>
                <label class="block mb-1 font-semibold">الحالة</label>
                <select name="status" required class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400">
                    <option value="pending" @selected(old('status', $appointment->status ?? '')=='pending')>قيد الانتظار</option>
                    <option value="confirmed" @selected(old('status', $appointment->status ?? '')=='confirmed')>مؤكد</option>
                    <option value="completed" @selected(old('status', $appointment->status ?? '')=='completed')>مكتمل</option>
                    <option value="cancelled" @selected(old('status', $appointment->status ?? '')=='cancelled')>ملغى</option>
                </select>
            </div>

            {{-- الأزرار --}}
            <div class="flex flex-col sm:flex-row gap-2">
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    {{ isset($appointment) ? 'تحديث' : 'حفظ' }}
                </button>
                <a href="{{ route('appointments.index') }}"
                   class="px-6 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 text-center">
                    إلغاء
                </a>
            </div>

        </form>
    </div>
</x-app-layout>

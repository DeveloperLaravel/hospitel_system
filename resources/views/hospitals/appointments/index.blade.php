<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">المواعيد</h1>
            @hasanyrole('admin|reception')
                <a href="{{ route('appointments.create') }}"
                   class="mt-2 sm:mt-0 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    ➕ إضافة موعد
                </a>
            @endhasanyrole
        </div>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">

        {{-- رسالة النجاح --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- جدول المواعيد --}}
        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700 text-center">#</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700 text-center">المريض</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700 text-center">الطبيب</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700 text-center">التاريخ</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700 text-center">الوقت</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700 text-center">الحالة</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700 text-center">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-center">
                    @forelse($appointments as $appointment)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $appointment->id }}</td>
                            <td class="px-4 py-2">{{ $appointment->patient->name }}</td>
                            <td class="px-4 py-2">{{ $appointment->doctor->name }}</td>
                            <td class="px-4 py-2">{{ $appointment->date }}</td>
                            <td class="px-4 py-2">{{ $appointment->time }}</td>
                            <td class="px-4 py-2 capitalize">
                                @if($appointment->status == 'pending')
                                    <span class="px-2 py-1 bg-yellow-200 text-yellow-800 rounded-full">قيد الانتظار</span>
                                @elseif($appointment->status == 'confirmed')
                                    <span class="px-2 py-1 bg-blue-200 text-blue-800 rounded-full">مؤكد</span>
                                @elseif($appointment->status == 'completed')
                                    <span class="px-2 py-1 bg-green-200 text-green-800 rounded-full">مكتمل</span>
                                @elseif($appointment->status == 'cancelled')
                                    <span class="px-2 py-1 bg-red-200 text-red-800 rounded-full">ملغى</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 flex flex-col sm:flex-row justify-center items-center gap-2">
                                <a href="{{ route('appointments.show', $appointment) }}"
                                   class="px-2 py-1 bg-green-400 text-white rounded hover:bg-green-500 transition">
                                    عرض
                                </a>
                                @hasanyrole('admin|reception')
                                    <a href="{{ route('appointments.edit', $appointment) }}"
                                       class="px-2 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 transition">
                                        تعديل
                                    </a>
                                    <form action="{{ route('appointments.destroy', $appointment) }}" method="POST"
                                          onsubmit="return confirm('هل أنت متأكد من الحذف؟');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                            حذف
                                        </button>
                                    </form>
                                @endhasanyrole
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-4 text-gray-500 text-center">لا توجد مواعيد حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $appointments->links() }}
        </div>

    </div>
</x-app-layout>

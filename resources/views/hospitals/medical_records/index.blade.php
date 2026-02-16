<x-app-layout>
        <div class="flex flex-col sm:flex-row justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">السجلات الطبية</h1>
            @hasanyrole('admin|doctor')
                <a href="{{ route('medical_records.create') }}"
                   class="mt-2 sm:mt-0 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    ➕ إضافة سجل طبي
                </a>
            @endhasanyrole
        </div>

    <div class="py-6 max-w-6xl mx-auto">

        {{-- رسالة النجاح --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- جدول السجلات --}}
        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="min-w-full divide-y divide-gray-200 text-center">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700">#</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700">المريض</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700">الطبيب</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700">التشخيص</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($records as $record)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $record->id }}</td>
                            <td class="px-4 py-2">{{ $record->patient->name }}</td>
                            <td class="px-4 py-2">{{ $record->doctor->name }}</td>
                            <td class="px-4 py-2">{{ Str::limit($record->diagnosis, 50) }}</td>
                            <td class="px-4 py-2 flex flex-col sm:flex-row justify-center items-center gap-2">
                                <a href="{{ route('medical_records.show', $record) }}"
                                   class="px-2 py-1 bg-green-400 text-white rounded hover:bg-green-500 transition">
                                    عرض
                                </a>
                                @hasanyrole('admin|doctor')
                                    <a href="{{ route('medical_records.edit', $record) }}"
                                       class="px-2 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 transition">
                                        تعديل
                                    </a>
                                    <form action="{{ route('medical_records.destroy', $record) }}" method="POST"
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
                            <td colspan="5" class="px-4 py-4 text-gray-500 text-center">لا توجد سجلات طبية حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $records->links() }}
        </div>

    </div>
</x-app-layout>

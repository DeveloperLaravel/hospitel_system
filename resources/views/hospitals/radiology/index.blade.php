<x-app-layout title="الأشعة">

    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-4">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">قائمة الأشعة</h2>

        @can('radiology.create')
        <a href="{{ route('radiologies.create') }}"
           class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
            + إضافة أشعة
        </a>
        @endcan
    </div>

    {{-- الرسائل --}}
    @if(session('success'))
        <div class="bg-green-200 dark:bg-green-700 text-green-800 dark:text-green-100 p-2 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full bg-white dark:bg-gray-800 shadow rounded-lg">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="p-2 text-left">#</th>
                    <th class="p-2 text-left">المريض</th>
                    <th class="p-2 text-left">الطبيب</th>
                    <th class="p-2 text-left">نوع الأشعة</th>
                    <th class="p-2 text-left">الحالة</th>
                    <th class="p-2 text-left">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($radiologies as $scan)
                <tr class="border-b border-gray-200 dark:border-gray-600">
                    <td class="p-2">{{ $scan->id }}</td>
                    <td class="p-2">{{ $scan->patient->name }}</td>
                    <td class="p-2">{{ $scan->doctor->name }}</td>
                    <td class="p-2">{{ $scan->scan_type }}</td>
                    <td class="p-2">
                        <span class="{{ $scan->status == 'completed' ? 'text-green-600 dark:text-green-400' : 'text-yellow-600 dark:text-yellow-400' }}">
                            {{ ucfirst($scan->status) }}
                        </span>
                    </td>
                    <td class="p-2 flex flex-wrap gap-1">
                        <a href="{{ route('radiologies.show', $scan) }}"
                           class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg transition">
                            عرض
                        </a>

                        @can('radiology.edit')
                        <a href="{{ route('radiologies.edit', $scan) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg transition">
                            تعديل
                        </a>
                        @endcan

                        @can('radiology.complete')
                            @if($scan->status == 'pending')
                            <form action="{{ route('radiologies.complete', $scan) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <x-button class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded-lg transition">
                                    إتمام
                                </x-button>
                            </form>
                            @endif
                        @endcan

                        @can('radiology.delete')
                        <form action="{{ route('radiologies.destroy', $scan) }}" method="POST" class="inline"
                              onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                            @csrf
                            @method('DELETE')
                            <x-button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg transition">
                                حذف
                            </x-button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center p-4 text-gray-500 dark:text-gray-400">لا توجد أشعة مسجلة.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $radiologies->links() }}
    </div>

</x-app-layout>

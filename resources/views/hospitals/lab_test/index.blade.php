<x-app-layout title="تحاليل المختبر">

    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">تحاليل المختبر</h2>

            @can('labtest.create')
                <a href="{{ route('lab_tests.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                    + إضافة تحليل جديد
                </a>
            @endcan
        </div>

        {{-- رسالة نجاح --}}
        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-200 dark:bg-green-700 text-green-800 dark:text-green-100">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="px-4 py-2 text-left">المريض</th>
                        <th class="px-4 py-2 text-left">الطبيب</th>
                        <th class="px-4 py-2 text-left">اسم التحليل</th>
                        <th class="px-4 py-2 text-left">الحالة</th>
                        <th class="px-4 py-2 text-left">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($labTests as $test)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-4 py-2">{{ $test->id }}</td>
                            <td class="px-4 py-2">{{ $test->patient->name }}</td>
                            <td class="px-4 py-2">{{ $test->doctor->name }}</td>
                            <td class="px-4 py-2">{{ $test->test_name }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded-lg text-sm font-medium
                                    {{ $test->status == 'completed' ? 'bg-green-200 dark:bg-green-600 text-green-800 dark:text-green-100' : 'bg-yellow-200 dark:bg-yellow-600 text-yellow-800 dark:text-yellow-100' }}">
                                    {{ ucfirst($test->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 flex flex-wrap gap-2">

                                <a href="{{ route('lab_tests.show',$test) }}"
                                   class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded transition">
                                    عرض
                                </a>

                                @can('labtest.edit')
                                    <a href="{{ route('lab_tests.edit',$test) }}"
                                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded transition">
                                        تعديل
                                    </a>
                                @endcan

                                @can('labtest.complete')
                                    @if($test->status == 'pending')
                                        <form action="{{ route('lab_tests.complete',$test) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <x-button class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded">
                                                إتمام
                                            </x-button>
                                        </form>
                                    @endif
                                @endcan

                                @can('labtest.delete')
                                    <form action="{{ route('lab_tests.destroy',$test) }}" method="POST" class="inline"
                                          onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                        @csrf
                                        @method('DELETE')
                                        <x-button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                            حذف
                                        </x-button>
                                    </form>
                                @endcan

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500 dark:text-gray-300">لا توجد تحاليل</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $labTests->links() }}
        </div>

    </div>

</x-app-layout>

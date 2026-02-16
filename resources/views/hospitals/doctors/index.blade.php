<x-app-layout>

            {{-- زر إضافة طبيب يظهر فقط لمن يملك صلاحية doctors.create --}}
            @can('doctors.create')
                <a href="{{ route('doctors.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    ➕ إضافة طبيب
                </a>
            @endcan

    <div class="py-4 space-y-4">

        <!-- رسالة نجاح -->
        @if(session('success'))
            <div class="p-3 bg-green-200 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- جدول الأطباء -->
        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">#</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">الاسم</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">القسم</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">التخصص</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">الهاتف</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">رقم الترخيص</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($doctors as $doctor)
                        <tr>
                            <td class="px-4 py-2">{{ $doctor->id }}</td>
                            <td class="px-4 py-2">{{ $doctor->name }}</td>
                            <td class="px-4 py-2">{{ $doctor->department->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $doctor->specialization }}</td>
                            <td class="px-4 py-2">{{ $doctor->phone }}</td>
                            <td class="px-4 py-2">{{ $doctor->license_number }}</td>
                            <td class="px-4 py-2 flex space-x-2">

                                {{-- زر تعديل يظهر فقط لمن يملك صلاحية doctors.edit --}}
                                @can('doctors.edit')
                                    <a href="{{ route('doctors.edit', $doctor) }}"
                                       class="px-2 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 transition">
                                        ✏️ تعديل
                                    </a>
                                @endcan

                                {{-- زر حذف يظهر فقط لمن يملك صلاحية doctors.delete --}}
                                @can('doctors.delete')
                                    <form action="{{ route('doctors.destroy', $doctor) }}" method="POST"
                                          onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                            🗑 حذف
                                        </button>
                                    </form>
                                @endcan

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-4 text-center text-gray-500">
                                لا يوجد أطباء مسجلون.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- الترقيم / Pagination -->
        <div class="mt-4">
            {{ $doctors->links() }}
        </div>

    </div>
</x-app-layout>

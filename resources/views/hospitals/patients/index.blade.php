<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            🏥 قائمة المرضى
        </h1>
    </x-slot>

    <div class="py-4 max-w-5xl mx-auto space-y-4">

        {{-- زر إضافة مريض يظهر فقط لمن يملك صلاحية patients.create --}}
        @can('patients.create')
            <a href="{{ route('patients.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                ➕ إضافة مريض
            </a>
        @endcan

        {{-- رسالة النجاح --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- جدول المرضى --}}
        <x-table>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>رقم الهوية</th>
                    <th>العمر</th>
                    <th>الجنس</th>
                    <th>الهاتف</th>
                    <th>الإجراءات</th>
                </tr>

                @forelse($patients as $patient)
                    <tr>
                        <td>{{ $patient->id }}</td>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->national_id }}</td>
                        <td>{{ $patient->age }}</td>
                        <td>{{ $patient->gender }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td class="space-x-2 flex">
                            {{-- زر عرض --}}
                            <a href="{{ route('patients.show', $patient) }}" class="bg-green-400 text-white">
                                عرض
                            </a>

                            {{-- زر تعديل يظهر لمن يملك صلاحية patients.edit --}}
                            @can('patients.edit')
                                <a href="{{ route('patients.edit', $patient) }}" class="bg-yellow-400 text-white">
                                    تعديل
                                </a>
                            @endcan

                            {{-- زر حذف يظهر لمن يملك صلاحية patients.delete --}}
                            @can('patients.delete')
                                <form action="{{ route('patients.destroy', $patient) }}" method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                    @csrf
                                    @method('DELETE')
                                    <x-button class="bg-red-500 text-white">حذف</x-button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center p-4 text-gray-500">
                            لا يوجد مرضى مسجلون.
                        </td>
                    </tr>
                @endforelse
        </x-table>

        {{-- الترقيم --}}
        <div class="mt-4">
            {{ $patients->links() }}
        </div>

    </div>
</x-app-layout>

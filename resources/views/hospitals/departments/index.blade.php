<x-app-layout>
    <x-slot name="title">الإدارات</x-slot>

    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">الإدارات</h1>
        <a href="{{ route('departments.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">➕ إضافة إدارة</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">#</th>
                <th class="p-2">الاسم</th>
                <th class="p-2">الوصف</th>
                <th class="p-2">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($departments as $department)
            <tr class="border-b">
                <td class="p-2">{{ $department->id }}</td>
                <td class="p-2">{{ $department->name }}</td>
                <td class="p-2">{{ $department->description }}</td>
                <td class="p-2 space-x-2">
                    <a href="{{ route('departments.edit', $department) }}" class="px-2 py-1 bg-yellow-400 text-white rounded">تعديل</a>
                    <form action="{{ route('departments.destroy', $department) }}" method="POST" class="inline-block" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                        @csrf
                        @method('DELETE')
                        <button class="px-2 py-1 bg-red-500 text-white rounded">حذف</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-4 text-center">لا توجد إدارات حالياً.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $departments->links() }}
    </div>
</x-app-layout>

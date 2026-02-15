<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">قائمة الأدوار</h1>

        <a href="{{ route('roles.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">➕ إضافة دور</a>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-2">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-2 py-1">#</th>
                    <th class="border px-2 py-1">اسم الدور</th>
                    <th class="border px-2 py-1">الصلاحيات</th>
                    <th class="border px-2 py-1">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                    <td class="border px-2 py-1">{{ $role->name }}</td>
                    <td class="border px-2 py-1">{{ $role->permissions->pluck('name')->join(', ') }}</td>
                    <td class="border px-2 py-1">
                        <a href="{{ route('roles.edit', $role) }}" class="bg-yellow-400 text-white px-2 py-1 rounded">تعديل</a>
                        <form action="{{ route('roles.destroy', $role) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

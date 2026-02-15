<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">قائمة المستخدمين</h1>

        <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">➕ إضافة مستخدم</a>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-2">
                {{ session('success') }}
            </div>
        @endif
@if(session('error'))
    <div class="bg-red-200 text-red-800 p-2 rounded mb-2">
        {{ session('error') }}
    </div>
@endif
        <table class="w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-2 py-1">#</th>
                    <th class="border px-2 py-1">الاسم</th>
                    <th class="border px-2 py-1">الإيميل</th>
                    <th class="border px-2 py-1">الدور</th>
                    <th class="border px-2 py-1">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                    <td class="border px-2 py-1">{{ $user->name }}</td>
                    <td class="border px-2 py-1">{{ $user->email }}</td>
                    <td class="border px-2 py-1">{{ $user->roles->pluck('name')->join(', ') }}</td>
                    <td class="border px-2 py-1">
  @if($user->id != 0 && !$user->hasRole('admin'))
        <a href="{{ route('users.edit', $user) }}" class="bg-yellow-400 text-white px-2 py-1 rounded">تعديل</a>
        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
        </form>
    @else
        <span class="text-gray-500">محمي</span>
    @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">إضافة دور جديد</h1>

        <form action="{{ route('roles.store') }}" method="POST" class="space-y-3">
            @csrf
            <div>
                <label>اسم الدور</label>
                <input type="text" name="name" value="{{ old('name') }}" class="border p-2 w-full">
            </div>

            <div>
                <label>الصلاحيات</label>
                <div class="grid grid-cols-3 gap-2">
                    @foreach($permissions as $permission)
                        <label class="inline-flex items-center gap-2">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}">
                            {{ $permission->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">حفظ</button>
        </form>
    </div>
</x-app-layout>

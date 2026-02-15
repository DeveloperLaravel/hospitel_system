<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">تعديل الدور</h1>

        <form action="{{ route('roles.update', $role) }}" method="POST" class="space-y-3">
            @csrf
            @method('PUT')

            <div>
                <label>اسم الدور</label>
                <input type="text" name="name" value="{{ old('name', $role->name) }}" class="border p-2 w-full">
            </div>

            <div>
                <label>الصلاحيات</label>
                <div class="grid grid-cols-3 gap-2">
                    @foreach($permissions as $permission)
                        <label class="inline-flex items-center gap-2">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                   @if($role->hasPermissionTo($permission->name)) checked @endif>
                            {{ $permission->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">تحديث</button>
        </form>
    </div>
</x-app-layout>

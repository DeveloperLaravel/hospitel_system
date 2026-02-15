<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">تعديل الصلاحية</h1>

        <form action="{{ route('permissions.update', $permission) }}" method="POST" class="space-y-3">
            @csrf
            @method('PUT')

            <div>
                <label>اسم الصلاحية</label>
                <input type="text" name="name" value="{{ old('name', $permission->name) }}" class="border p-2 w-full">
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">تحديث</button>
        </form>
    </div>
</x-app-layout>

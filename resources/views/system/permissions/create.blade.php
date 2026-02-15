<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">إضافة صلاحية جديدة</h1>

        <form action="{{ route('permissions.store') }}" method="POST" class="space-y-3">
            @csrf
            <div>
                <label>اسم الصلاحية</label>
                <input type="text" name="name" value="{{ old('name') }}" class="border p-2 w-full">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">حفظ</button>
        </form>
    </div>
</x-app-layout>

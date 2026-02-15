<x-app-layout>
    <x-slot name="title">إضافة إدارة</x-slot>

    <h1 class="text-2xl font-bold mb-4">إضافة إدارة</h1>

    @if($errors->any())
        <div class="mb-4 p-2 bg-red-200 text-red-800 rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('departments.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        <div>
            <label class="block mb-1 font-semibold">الاسم</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border p-2 rounded" placeholder="أدخل اسم الإدارة">
        </div>
        <div>
            <label class="block mb-1 font-semibold">الوصف</label>
            <textarea name="description" class="w-full border p-2 rounded" placeholder="أدخل وصف الإدارة">{{ old('description') }}</textarea>
        </div>
        <div class="flex space-x-2">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">حفظ</button>
            <a href="{{ route('departments.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded">إلغاء</a>
        </div>
    </form>
</x-app-layout>

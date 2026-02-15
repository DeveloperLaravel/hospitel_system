<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">إضافة مستخدم جديد</h1>

        <form action="{{ route('users.store') }}" method="POST" class="space-y-3">
            @csrf
            <div>
                <label>الاسم</label>
                <input type="text" name="name" value="{{ old('name') }}" class="border p-2 w-full">
            </div>

            <div>
                <label>الإيميل</label>
                <input type="email" name="email" value="{{ old('email') }}" class="border p-2 w-full">
            </div>

            <div>
                <label>كلمة المرور</label>
                <input type="password" name="password" class="border p-2 w-full">
            </div>

            <div>
                <label>تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" class="border p-2 w-full">
            </div>

            <div>
                <label>الدور</label>
                <select name="role" class="border p-2 w-full">
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">حفظ</button>
        </form>
    </div>
</x-app-layout>

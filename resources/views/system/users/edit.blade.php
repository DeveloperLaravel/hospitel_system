<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">تعديل المستخدم</h1>

        <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-3">
            @csrf
            @method('PUT')

            <div>
                <label>الاسم</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="border p-2 w-full">
            </div>

            <div>
                <label>الإيميل</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="border p-2 w-full">
            </div>

            <div>
                <label>كلمة المرور (اختياري)</label>
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
                        <option value="{{ $role->name }}" @if($user->hasRole($role->name)) selected @endif>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">تحديث</button>
        </form>
    </div>
</x-app-layout>

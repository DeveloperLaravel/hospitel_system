<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{
    use HasRoles;
    // عرض كل المستخدمين
    public function index()
    {
        $users = User::with('roles')->get();
        return view('system.users.index', compact('users'));
    }

    // عرض نموذج إضافة مستخدم جديد
    public function create()
    {
        $roles = Role::all();
        return view('system.users.create', compact('roles'));
    }

    // حفظ مستخدم جديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('users.index')->with('success', 'تم إنشاء المستخدم بنجاح');
    }

    // عرض نموذج تعديل مستخدم
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('system.users.edit', compact('user','roles'));
    }

    // تحديث بيانات المستخدم
   public function update(Request $request, User $user)
{
    // حماية المستخدم الأول أو أي مستخدم ذو دور Admin
    if ($user->id === 0 || $user->hasRole('admin')) {
        return redirect()->route('users.index')
            ->with('error', 'لا يمكن تعديل دور هذا المستخدم لأنه ذو صلاحيات عليا.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:6|confirmed',
        'role' => 'required|exists:roles,name',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if($request->filled('password')){
        $user->password = Hash::make($request->password);
    }

    $user->save();

    $user->syncRoles([$request->role]);

    return redirect()->route('users.index')
        ->with('success', 'تم تحديث المستخدم بنجاح');
}

public function destroy(User $user)
{
    // تحويل ID إلى integer للتأكد
    if ((int)$user->id === 1 || $user->hasRole('admin')) {
        return redirect()->route('users.index')
            ->with('error', 'لا يمكن حذف هذا المستخدم لأنه ذو صلاحيات عليا.');
    }

    $user->delete();

    return redirect()->route('users.index')
        ->with('success', 'تم حذف المستخدم بنجاح');
}

}

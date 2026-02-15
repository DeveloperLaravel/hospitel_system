<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{


    // عرض كل الأدوار
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('system.roles.index', compact('roles'));
    }

    // نموذج إنشاء دور جديد
    public function create()
    {
        $permissions = Permission::all();
        return view('system.roles.create', compact('permissions'));
    }

    // حفظ دور جديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array',
        ]);

        $role = Role::create(['name' => $request->name]);

        if ($request->permissions) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')->with('success', 'تم إنشاء الدور بنجاح');
    }

    // نموذج تعديل الدور
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('system.roles.edit', compact('role', 'permissions'));
    }

    // تحديث الدور
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array',
        ]);

        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('roles.index')->with('success', 'تم تحديث الدور بنجاح');
    }

    // حذف الدور
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'تم حذف الدور بنجاح');
    }
}

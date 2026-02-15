<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // عرض كل الصلاحيات
    public function index()
    {
        $permissions = Permission::all();
        return view('system.permissions.index', compact('permissions'));
    }

    // نموذج إنشاء صلاحية جديدة
    public function create()
    {
        return view('system.permissions.create');
    }

    // حفظ صلاحية جديدة
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('permissions.index')->with('success', 'تم إنشاء الصلاحية بنجاح');
    }

    // نموذج تعديل صلاحية
    public function edit(Permission $permission)
    {
        return view('system.permissions.edit', compact('permission'));
    }

    // تحديث الصلاحية
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);

        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('permissions.index')->with('success', 'تم تحديث الصلاحية بنجاح');
    }

    // حذف الصلاحية
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'تم حذف الصلاحية بنجاح');
    }
}

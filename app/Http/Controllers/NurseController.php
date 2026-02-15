<?php

namespace App\Http\Controllers;

use App\Models\Nurse;
use App\Models\Department;
use Illuminate\Http\Request;

class NurseController extends Controller
{


    public function index()
    {
        $nurses = Nurse::with('department')->latest()->paginate(10);
        return view('hospitals.nurses.index', compact('nurses'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('hospitals.nurses.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'department_id' => 'required|exists:departments,id',
        ]);

        Nurse::create($request->all());

        return redirect()->route('nurses.index')->with('success','Nurse created successfully.');
    }

    public function show(Nurse $nurse)
    {
        $nurse->load('department');
        return view('hospitals.nurses.show', compact('nurse'));
    }

    public function edit(Nurse $nurse)
    {
        $departments = Department::all();
        return view('hospitals.nurses.edit', compact('nurse','departments'));
    }

    public function update(Request $request, Nurse $nurse)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'department_id' => 'required|exists:departments,id',
        ]);

        $nurse->update($request->all());

        return redirect()->route('nurses.index')->with('success','Nurse updated successfully.');
    }

    public function destroy(Nurse $nurse)
    {
        $nurse->delete();
        return redirect()->route('nurses.index')->with('success','Nurse deleted successfully.');
    }
}

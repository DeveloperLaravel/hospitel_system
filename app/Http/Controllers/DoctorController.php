<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Department;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        // عرض كل الأطباء مع القسم
        $doctors = Doctor::with('department')->latest()->paginate(10);
        return view('hospitals.doctors.index', compact('doctors'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('hospitals.doctors.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'specialization' => 'required|string|max:255',
            'license_number' => 'nullable|string|max:50|unique:doctors,license_number',
        ]);

        Doctor::create($request->all());

        return redirect()->route('doctors.index')
                         ->with('success', 'Doctor created successfully.');
    }

    public function edit(Doctor $doctor)
    {
        $departments = Department::all();
        return view('hospitals.doctors.edit', compact('doctor', 'departments'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'specialization' => 'required|string|max:255',
            'license_number' => 'nullable|string|max:50|unique:doctors,license_number,' . $doctor->id,
        ]);

        $doctor->update($request->all());

        return redirect()->route('doctors.index')
                         ->with('success', 'Doctor updated successfully.');
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return redirect()->route('doctors.index')
                         ->with('success', 'Doctor deleted successfully.');
    }
}

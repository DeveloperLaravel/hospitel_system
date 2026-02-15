<?php

namespace App\Http\Controllers;

use App\Models\LabTest;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class LabTestController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:labtest.view')->only(['index','show']);
    //     $this->middleware('permission:labtest.create')->only(['create','store']);
    //     $this->middleware('permission:labtest.edit')->only(['edit','update']);
    //     $this->middleware('permission:labtest.delete')->only(['destroy']);
    //     $this->middleware('permission:labtest.complete')->only(['complete']);
    // }

    public function index()
    {
        $labTests = LabTest::with('patient','doctor')->latest()->paginate(10);
        return view('hospitals.lab_test.index', compact('labTests'));
    }

    public function create()
    {
        return view('hospitals.lab_test.create', [
            'patients' => Patient::all(),
            'doctors' => Doctor::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'test_name' => 'required|string|max:255',
        ]);

        LabTest::create($validated);

        return redirect()->route('lab_tests.index')
            ->with('success','Lab Test created successfully.');
    }

    public function show(LabTest $labTest)
    {
        return view('hospitals.lab_tests.show', compact('labTest'));
    }

    public function edit(LabTest $labTest)
    {
        return view('hospitals.lab_tests.edit', [
            'labTest' => $labTest,
            'patients' => Patient::all(),
            'doctors' => Doctor::all(),
        ]);
    }

    public function update(Request $request, LabTest $labTest)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'test_name' => 'required|string|max:255',
            'result' => 'nullable|string',
            'status' => 'required|in:pending,completed',
        ]);

        $labTest->update($validated);

        return redirect()->route('lab_tests.index')
            ->with('success','Lab Test updated successfully.');
    }

    public function destroy(LabTest $labTest)
    {
        $labTest->delete();

        return redirect()->route('lab_tests.index')
            ->with('success','Lab Test deleted successfully.');
    }

    // تغيير الحالة إلى مكتمل
    public function complete(LabTest $labTest)
    {
        $labTest->update([
            'status' => 'completed'
        ]);

        return back()->with('success','Test marked as completed.');
    }
}

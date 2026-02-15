<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{


    public function index()
    {
        $patients = Patient::latest()->paginate(10);
        return view('hospitals.patients.index', compact('patients'));
    }

    public function create()
    {
        return view('hospitals.patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'national_id' => 'nullable|string|max:20|unique:patients,national_id',
            'age' => 'nullable|integer|min:0',
            'gender' => 'nullable|in:male,female',
            'phone' => 'nullable|string|max:20',
            'blood_type' => 'nullable|string|max:5',
            'address' => 'nullable|string|max:1000',
        ]);

        Patient::create($request->all());

        return redirect()->route('patients.index')
                         ->with('success', 'Patient created successfully.');
    }

    public function show(Patient $patient)
    {
        $patient->load('appointments', 'medicalRecords', 'invoices', 'insurance');
        return view('hospitals.patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('hospitals.patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'national_id' => 'nullable|string|max:20|unique:patients,national_id,' . $patient->id,
            'age' => 'nullable|integer|min:0',
            'gender' => 'nullable|in:male,female',
            'phone' => 'nullable|string|max:20',
            'blood_type' => 'nullable|string|max:5',
            'address' => 'nullable|string|max:1000',
        ]);

        $patient->update($request->all());

        return redirect()->route('patients.index')
                         ->with('success', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')
                         ->with('success', 'Patient deleted successfully.');
    }
}

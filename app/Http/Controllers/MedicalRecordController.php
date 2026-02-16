<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{

    public function index()
    {

        $records = MedicalRecord::with(['patient', 'doctor'])->latest()->paginate(10);
        return view('hospitals.medical_records.index', compact('records'));
    }

    public function create()
    {
        $patients = Patient::orderBy('name')->get();
        $doctors  = Doctor::orderBy('name')->get();
        return view('hospitals.medical_records.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'diagnosis' => 'nullable|string',
            'treatment' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        MedicalRecord::create($request->all());

        return redirect()->route('medical_records.index')
                         ->with('success', 'Medical record created successfully.');
    }

    public function show(MedicalRecord $medicalRecord)
    {
        $medicalRecord->load(['patient', 'doctor']);
        return view('hospitals.medical_records.show', compact('medicalRecord'));
    }

    public function edit(MedicalRecord $medicalRecord)
    {
       $patients = Patient::orderBy('name')->get();
        $doctors  = Doctor::orderBy('name')->get();
        return view('hospitals.medical_records.edit', compact('medicalRecord', 'patients', 'doctors'));
    }

    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'diagnosis' => 'nullable|string',
            'treatment' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $medicalRecord->update($request->all());

        return redirect()->route('medical_records.index')
                         ->with('success', 'Medical record updated successfully.');
    }

    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();
        return redirect()->route('medical_records.index')
                         ->with('success', 'Medical record deleted successfully.');
    }
}

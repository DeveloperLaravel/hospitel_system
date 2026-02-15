<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\MedicalRecord;
use App\Models\Medicine;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{

    public function index()
    {
        $prescriptions = Prescription::with(['medicalRecord.patient','medicine'])->latest()->paginate(10);
        return view('prescriptions.index', compact('prescriptions'));
    }

    public function create()
    {
        $medicalRecords = MedicalRecord::with('patient')->get();
        $medicines = Medicine::all();
        return view('prescriptions.create', compact('medicalRecords','medicines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
            'medicine_id' => 'required|exists:medicines,id',
            'dosage' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
        ]);

        Prescription::create($request->all());

        return redirect()->route('prescriptions.index')->with('success','Prescription created successfully.');
    }

    public function show(Prescription $prescription)
    {
        $prescription->load(['medicalRecord.patient','medicine']);
        return view('prescriptions.show', compact('prescription'));
    }

    public function edit(Prescription $prescription)
    {
        $medicalRecords = MedicalRecord::with('patient')->get();
        $medicines = Medicine::all();
        return view('prescriptions.edit', compact('prescription','medicalRecords','medicines'));
    }

    public function update(Request $request, Prescription $prescription)
    {
        $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
            'medicine_id' => 'required|exists:medicines,id',
            'dosage' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
        ]);

        $prescription->update($request->all());

        return redirect()->route('prescriptions.index')->with('success','Prescription updated successfully.');
    }

    public function destroy(Prescription $prescription)
    {
        $prescription->delete();
        return redirect()->route('prescriptions.index')->with('success','Prescription deleted successfully.');
    }
}

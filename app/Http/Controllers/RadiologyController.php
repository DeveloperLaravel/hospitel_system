<?php

namespace App\Http\Controllers;

use App\Models\Radiology;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Prescription;
use Illuminate\Http\Request;

class RadiologyController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:radiology.view')->only(['index','show']);
    //     $this->middleware('permission:radiology.create')->only(['create','store']);
    //     $this->middleware('permission:radiology.edit')->only(['edit','update']);
    //     $this->middleware('permission:radiology.delete')->only(['destroy']);
    //     $this->middleware('permission:radiology.complete')->only(['complete']);
    // }

    public function index()
    {
    // جلب كل الأشعة مع العلاقة بالمرضى والأطباء
    $radiologies = Radiology::with(['patient', 'doctor'])->paginate(10);

    // إذا كنت تحتاج وصفات مرتبطة بالاشعة
    $prescriptions = Prescription::all(); // أو حسب الحاجة للفلاتر

    return view('hospitals.radiology.index', compact('radiologies', 'prescriptions'));
    }

    public function create()
    {
        return view('hospitals.radiology.create', [
            'patients' => Patient::all(),
            'doctors' => Doctor::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'scan_type' => 'required|string|max:255',
        ]);

        Radiology::create($validated);

        return redirect()->route('radiologies.index')
            ->with('success','Radiology created successfully.');
    }

    public function show(Radiology $radiology)
    {
        return view('hospitals.radiology.show', compact('radiology'));
    }

    public function edit(Radiology $radiology)
    {
        return view('hospitals.radiology.edit', [
            'radiology' => $radiology,
            'patients' => Patient::all(),
            'doctors' => Doctor::all(),
        ]);
    }

    public function update(Request $request, Radiology $radiology)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'scan_type' => 'required|string|max:255',
            'result' => 'nullable|string',
            'status' => 'required|in:pending,completed',
        ]);

        $radiology->update($validated);

        return redirect()->route('radiologies.index')
            ->with('success','Radiology updated successfully.');
    }

    public function destroy(Radiology $radiology)
    {
        $radiology->delete();

        return redirect()->route('radiologies.index')
            ->with('success','Radiology deleted successfully.');
    }

    public function complete(Radiology $radiology)
    {
        $radiology->update(['status' => 'completed']);

        return back()->with('success','Scan completed.');
    }
}

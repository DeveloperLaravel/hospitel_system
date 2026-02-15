<?php

namespace App\Http\Controllers;

use App\Models\BedAssignment;
use App\Models\Patient;
use App\Models\Room;
use Illuminate\Http\Request;

class BedAssignmentController extends Controller
{


    public function index()
    {
        $assignments = BedAssignment::with('patient','room')->latest()->paginate(10);
        return view('bed_assignments.index', compact('assignments'));
    }

    public function create()
    {
        $patients = Patient::all();
        $rooms = Room::where('status','available')->get(); // فقط الغرف المتاحة
        return view('bed_assignments.create', compact('patients','rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $assignment = BedAssignment::create($request->all());

        // تحديث حالة الغرفة إلى occupied
        $assignment->room->update(['status'=>'occupied']);

        return redirect()->route('bed_assignments.index')->with('success','Bed assigned successfully.');
    }

    public function show(BedAssignment $bedAssignment)
    {
        $bedAssignment->load('patient','room');
        return view('bed_assignments.show', compact('bedAssignment'));
    }

    public function edit(BedAssignment $bedAssignment)
    {
        $patients = Patient::all();
        $rooms = Room::all();
        return view('bed_assignments.edit', compact('bedAssignment','patients','rooms'));
    }

    public function update(Request $request, BedAssignment $bedAssignment)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $oldRoom = $bedAssignment->room;
        $bedAssignment->update($request->all());

        // تحديث الغرف: الغرفة القديمة متاحة إذا لم تعد مستخدمة
        if ($oldRoom->id != $bedAssignment->room_id) {
            $oldRoom->update(['status'=>'available']);
            $bedAssignment->room->update(['status'=>'occupied']);
        }

        return redirect()->route('bed_assignments.index')->with('success','Bed assignment updated successfully.');
    }

    public function destroy(BedAssignment $bedAssignment)
    {
        $room = $bedAssignment->room;
        $bedAssignment->delete();

        // إعادة الغرفة إلى متاحة
        $room->update(['status'=>'available']);

        return redirect()->route('bed_assignments.index')->with('success','Bed assignment deleted successfully.');
    }
}

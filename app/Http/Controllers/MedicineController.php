<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{

    public function index()
    {
        $medicines = Medicine::latest()->paginate(10);
        return view('hospitals.medicines.index', compact('medicines'));
    }

    public function create()
    {
        return view('hospitals.medicines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'nullable|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'expiry_date' => 'nullable|date',
        ]);

        Medicine::create($request->all());

        return redirect()->route('medicines.index')->with('success', 'Medicine created successfully.');
    }

    public function show(Medicine $medicine)
    {
        return view('hospitals.medicines.show', compact('medicine'));
    }

    public function edit(Medicine $medicine)
    {
        return view('hospitals.medicines.edit', compact('medicine'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'nullable|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'expiry_date' => 'nullable|date',
        ]);

        $medicine->update($request->all());

        return redirect()->route('medicines.index')->with('success', 'Medicine updated successfully.');
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->route('medicines.index')->with('success', 'Medicine deleted successfully.');
    }
}

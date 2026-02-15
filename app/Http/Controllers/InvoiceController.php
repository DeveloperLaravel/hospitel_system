<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Medicine;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index()
    {
        $invoices = Invoice::with('patient')->latest()->paginate(10);
        return view('hospitals.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $patients = Patient::all();
        $medicines = Medicine::all();
        return view('hospitals.invoices.create', compact('patients','medicines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'status' => 'required|in:paid,unpaid',
            'medicines.*' => 'required|exists:medicines,id',
            'quantities.*' => 'required|integer|min:1',
        ]);

        $invoice = Invoice::create([
            'patient_id' => $request->patient_id,
            'status' => $request->status,
            'total' => 0,
        ]);

        $total = 0;
        foreach ($request->medicines as $index => $medicine_id) {
            $medicine = Medicine::find($medicine_id);
            $quantity = $request->quantities[$index];
            $price = $medicine->price * $quantity;
            $invoice->medicines()->attach($medicine_id, [
                'quantity' => $quantity,
                'price' => $price,
            ]);
            $total += $price;
        }

        $invoice->update(['total' => $total]);

        return redirect()->route('invoices.index')->with('success','Invoice created successfully.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('patient','medicines');
        return view('hospitals.invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $patients = Patient::all();
        $medicines = Medicine::all();
        $invoice->load('medicines');
        return view('hospitals.invoices.edit', compact('invoice','patients','medicines'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'status' => 'required|in:paid,unpaid',
            'medicines.*' => 'required|exists:medicines,id',
            'quantities.*' => 'required|integer|min:1',
        ]);

        $invoice->update([
            'patient_id' => $request->patient_id,
            'status' => $request->status,
        ]);

        $invoice->medicines()->detach();

        $total = 0;
        foreach ($request->medicines as $index => $medicine_id) {
            $medicine = Medicine::find($medicine_id);
            $quantity = $request->quantities[$index];
            $price = $medicine->price * $quantity;
            $invoice->medicines()->attach($medicine_id, [
                'quantity' => $quantity,
                'price' => $price,
            ]);
            $total += $price;
        }

        $invoice->update(['total' => $total]);

        return redirect()->route('invoices.index')->with('success','Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->medicines()->detach();
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success','Invoice deleted successfully.');
    }
}

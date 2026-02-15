<?php

namespace App\Http\Controllers;

use App\Models\InvoiceItem;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceItemController extends Controller
{


    public function index()
    {
        $items = InvoiceItem::with('invoice.patient')->latest()->paginate(10);
        return view('hospitals.invoice_items.index', compact('items'));
    }

    public function create()
    {
        $invoices = Invoice::with('patient')->get();
        return view('hospitals.invoice_items.create', compact('invoices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'service' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        InvoiceItem::create($request->all());

        // تحديث إجمالي الفاتورة
        $invoice = Invoice::find($request->invoice_id);
        $invoice->total = $invoice->medicines->sum(fn($m)=>$m->pivot->price) + $invoice->items()->sum('price');
        $invoice->save();

        return redirect()->route('invoice_items.index')->with('success','Invoice Item created successfully.');
    }

    public function show(InvoiceItem $invoiceItem)
    {
        $invoiceItem->load('invoice.patient');
        return view('hospitals.invoice_items.show', compact('invoiceItem'));
    }

    public function edit(InvoiceItem $invoiceItem)
    {
        $invoices = Invoice::with('patient')->get();
        return view('hospitals.invoice_items.edit', compact('invoiceItem','invoices'));
    }

    public function update(Request $request, InvoiceItem $invoiceItem)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'service' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $invoiceItem->update($request->all());

        // تحديث إجمالي الفاتورة
        $invoice = Invoice::find($request->invoice_id);
        $invoice->total = $invoice->medicines->sum(fn($m)=>$m->pivot->price) + $invoice->items()->sum('price');
        $invoice->save();

        return redirect()->route('invoice_items.index')->with('success','Invoice Item updated successfully.');
    }

    public function destroy(InvoiceItem $invoiceItem)
    {
        $invoice_id = $invoiceItem->invoice_id;
        $invoiceItem->delete();

        // تحديث إجمالي الفاتورة
        $invoice = Invoice::find($invoice_id);
        $invoice->total = $invoice->medicines->sum(fn($m)=>$m->pivot->price) + $invoice->items()->sum('price');
        $invoice->save();

        return redirect()->route('invoice_items.index')->with('success','Invoice Item deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\InstallmentsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Installments;
use Illuminate\Http\Request;

class InstallmentsController extends Controller
{
    /**
     * Display the listing of installments.
     */
    public function index(InstallmentsDataTable $dataTable)
    {
        return $dataTable->render('admin.installments.index');
    }

    /**
     * Show the form for creating a new installment.
     */
    public function create()
    {
        return view('admin.installments.create'); // Ensure you have a 'create' view.
    }

    /**
     * Store a newly created installment in storage.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'installment' => 'required',
            'date' => 'required|date',            // Ensure it's a valid date
            'amount' => 'required|numeric',       // Ensure it's a numeric value
            'payment_date' => 'required|date',    // Ensure it's a valid date
            'penalty' => 'required|numeric',      // Ensure it's a numeric value
            'status' => 'required|string',        // Ensure it's a valid string
        ]);

        // Create a new Installments instance
        Installments::create([
            'installment' => $request->installment,
            'date' => $request->date,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'penalty' => $request->penalty,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.installments.index')->with('success', 'Installments created successfully.');
    }

    /**
     * Show the form for editing the specified installment.
     */
    public function edit($id)
    {
        $installment = Installments::findOrFail($id);
        return view('admin.installments.edit', compact('installment'));
    }

    /**
     * Update the specified installment in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'installment' => 'required',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'penalty' => 'required|numeric',
            'status' => 'required|string',
        ]);

        // Find the installment by ID
        $installment = Installments::findOrFail($id);

        // Update the installment with new values
        $installment->update([
            'installment' => $request->installment,
            'date' => $request->date,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'penalty' => $request->penalty,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.installments.index')->with('success', 'Installments updated successfully.');
    }

    /**
     * Remove the specified installment from storage.
     */
    public function destroy($id)
    {
        $installment = Installments::findOrFail($id);
        $installment->delete();

        return redirect()->route('admin.installments.index')->with('success', 'Installments deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\LoanDataTable;
use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    // Display the listing of loans
    public function index(LoanDataTable $dataTable)
    {
        return $dataTable->render('admin.loans.index');
    }

    // Show the form for creating a new loan
    public function create()
    {
        return view('admin.loans.create'); // renders the create.blade.php form
    }

    // Store a newly created loan in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'rate' => 'required',
            'month' => 'required',
            'min_amount' => 'required',
            'max_amount' => 'required',
            'status' => 'required',
        ]);

        $loan = new Loan();
        $loan->name = $request->name;
        $loan->description = $request->description;
        $loan->rate = $request->rate;
        $loan->month = $request->month;
        $loan->min_amount = $request->min_amount;
        $loan->max_amount = $request->max_amount;
        $loan->status = $request->status;
        $loan->save();

        return redirect()->route('admin.loans.index')->with('success', 'Loan created successfully.');
    }

    // Show the form for editing the specified loan
    public function edit(string $id)
    {
        $loan = Loan::find($id);
        return view('admin.loans.edit', compact('loan'));
    }

    // Update the specified loan in storage
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'rate' => 'required',
            'month' => 'required',
            'min_amount' => 'required',
            'max_amount' => 'required',
            'status' => 'required',
        ]);

        $loan = Loan::find($id);
        $loan->name = $request->name;
        $loan->description = $request->description;
        $loan->rate = $request->rate;
        $loan->month = $request->month;
        $loan->min_amount = $request->min_amount;
        $loan->max_amount = $request->max_amount;
        $loan->status = $request->status;
        $loan->save();

        return redirect()->route('admin.loans.index')->with('success', 'Loan updated successfully.');
    }

    // Remove the specified loan from storage
    public function destroy(string $id)
    {
        $loan = Loan::find($id);
        $loan->delete();
        return redirect()->route('admin.loans.index')->with('success', 'Loan deleted successfully.');
    }


    // Front End Work
}

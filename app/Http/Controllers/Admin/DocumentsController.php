<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\DocumentsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Documents;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DocumentsDataTable $dataTable)
    {
        return $dataTable->render('admin.documents.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.documents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'file' => 'required|mimes:pdf,doc,docx,png,jpg,jpeg|max:10240',
        ]);

        // Create a new document record
        $documents = new Documents();
        $documents->status = $request->status;

        // Handle file upload if provided
        if ($request->hasFile('file')) {
            // Get the uploaded file
            $file = $request->file('file');
            // Generate a unique file name using the original extension
            $fileName = rand() . '.' . $file->getClientOriginalExtension();
            // Move the file to the public directory (user/profile/)
            $file->move(public_path('user/profile'), $fileName);
            // Save the file name in the database
            $documents->file = $fileName;
        }

        // Save the document to the database
        $documents->save();

        return redirect()->route('admin.documents.index')->with('success', 'Document created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $documents = Documents::findOrFail($id);
        return view('admin.documents.edit', compact('documents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx,png,jpg,jpeg|max:10240',
        ]);

        // Find the document to update
        $documents = Documents::findOrFail($id);
        $documents->status = $request->status;

        // Handle file upload if provided
        if ($request->hasFile('file')) {
            // Delete the old file if it exists
            $oldFilePath = public_path('user/profile') . '/' . $documents->file;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }

            // Get the uploaded file
            $file = $request->file('file');
            // Generate a new file name using the original extension
            $fileName = rand() . '.' . $file->getClientOriginalExtension();
            // Move the new file to the public directory (user/profile/)
            $file->move(public_path('user/profile'), $fileName);
            // Update the file name in the database
            $documents->file = $fileName;
        }

        // Save the document to the database
        $documents->save();

        return redirect()->route('admin.documents.index')->with('success', 'Document updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the document to delete
        $documents = Documents::findOrFail($id);

        // Delete the file from the server if it exists
        $filePath = public_path('user/profile') . '/' . $documents->file;
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete the document record from the database
        $documents->delete();

        return redirect()->route('admin.documents.index')->with('success', 'Document deleted successfully.');
    }
}

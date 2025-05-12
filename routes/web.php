<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Upload;
use App\Jobs\ProcessCsvUpload;

Route::get('/', function () {
    return view('uploads', [
        'uploads' => Upload::latest()->get()
    ]);
});

Route::post('/upload', function (Request $request) {
    $request->validate([
        'csv' => 'required|file|mimes:csv,txt'
    ]);

    $file = $request->file('csv');

    // Generate nama fail kekal
    $filename = uniqid() . '.' . $file->getClientOriginalExtension();

    // Simpan fail dalam folder uploads/ (jangan auto-delete)
    $filePath = $file->storeAs('private/uploads', $filename);


    // Simpan rekod dalam DB
    $upload = Upload::create([
        'filename' => $filePath,
        'status' => 'pending',
        'uploaded_at' => now(),
    ]);

    // Hantar ke queue
    dispatch(new ProcessCsvUpload($upload));

    return redirect('/')->with('success', 'File uploaded & processing started.');
});

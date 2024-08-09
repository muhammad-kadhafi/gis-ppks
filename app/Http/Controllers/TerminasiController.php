<?php

namespace App\Http\Controllers;

use App\Models\DataPpks;
use App\Models\Terminasi;
use Illuminate\Http\Request;

class TerminasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $terminasis = Terminasi::all();
        return view('terminasi', compact('terminasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'nama' => 'required|string|max:255',

        ]);

        $terminasi = Terminasi::create([
            'nama' => $request->nama,

        ]);

        return redirect()->back()->with('success', 'Terminasi created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Terminasi $terminasi)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        Terminasi::where('id', $terminasi->id)->update($validatedData);

        return redirect()->back()->with('success', 'Terminasi updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Terminasi $terminasi)
    {
        // Periksa apakah Terminasi masih digunakan di tabel DataPpks
        $isUsed = DataPpks::where('id_terminasi', $terminasi->id)->exists();

        if ($isUsed) {
            // Jika masih digunakan, kembalikan pesan kesalahan
            return redirect()->back()->with('error', 'Gagal menghapus Terminasi karena masih digunakan oleh data lain.');
        }

        // Jika tidak digunakan, hapus Terminasi
        $terminasi->delete();
        return redirect()->back()->with('success', 'Terminasi berhasil dihapus.');
    }
}

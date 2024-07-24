<?php

namespace App\Http\Controllers;
use App\Models\Jenis;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriterias = Jenis::all();
        return view('kriteria', compact('kriterias'));
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
        $request->validate([
            'jenis' => 'required|string|max:255',

        ]);

        $kriteria = jenis::create([
            'jenis' => $request->jenis,

        ]);

        return redirect()->back()->with('success', 'Kriteria created successfully.');
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
    public function update(Request $request, Jenis $kriterium)
    {
        $validatedData = $request->validate([
            'jenis' => 'required|string|max:255',
        ]);

        Jenis::where('id', $kriterium->id)->update($validatedData);

        return redirect()->back()->with('success', 'kriteria updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jenis $kriterium)
    {
        $kriterium->delete();
        return redirect()->back()->with('success', 'Kriteria deleted successfully.');
    }
}

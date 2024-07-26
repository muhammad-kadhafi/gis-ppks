<?php

namespace App\Http\Controllers;

use App\Models\DataPpks;
use App\Models\Jenis;
use App\Models\Terminasi;
use Illuminate\Http\Request;

class DatappksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ppkss = DataPpks::all();
        $kriterias = Jenis::all();
        $terminasis = Terminasi::all();
        return view('datappks')->with(compact('ppkss', 'kriterias', 'terminasis'));
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
            'id_kriteria' => 'required',
            'id_terminasi' => 'nullable',
            'nama' => 'required',
            'nik' => 'required',
            'tempatlahir' => 'required',
            'tanggallahir' => 'required',
            'umur' => 'required',
            'jeniskelamin' => 'required',
            'alamat' => 'required',
            'kecamatan' => 'required',
            'langitude' => 'required',
            'longatitude' => 'required',
        ]);

        $kriteria = DataPpks::create([
            'id_kriteria' => $request->id_kriteria,
            'id_terminasi' => $request->id_terminasi,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tempatlahir' => $request->tempatlahir,
            'tanggallahir' => $request->tanggallahir,
            'umur' => $request->umur,
            'jeniskelamin' => $request->jeniskelamin,
            'alamat' => $request->alamat,
            'kecamatan' => $request->kecamatan,
            'langitude' => $request->langitude,
            'longatitude' => $request->longatitude,
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kriteria' => 'required',
            'id_terminasi' => 'nullable',
            'nama' => 'required',
            'nik' => 'required',
            'tempatlahir' => 'required',
            'tanggallahir' => 'required',
            'umur' => 'required',
            'jeniskelamin' => 'required',
            'alamat' => 'required',
            'kecamatan' => 'required',
            'langitude' => 'required',
            'longatitude' => 'required',
        ]);

        $dataPpks = DataPpks::findOrFail($id);

        $dataPpks->id_kriteria = $request->id_kriteria;
        $dataPpks->id_terminasi = $request->id_terminasi;
        $dataPpks->nama = $request->nama;
        $dataPpks->nik = $request->nik;
        $dataPpks->tempatlahir = $request->tempatlahir;
        $dataPpks->tanggallahir = $request->tanggallahir;
        $dataPpks->umur = $request->umur;
        $dataPpks->jeniskelamin = $request->jeniskelamin;
        $dataPpks->alamat = $request->alamat;
        $dataPpks->kecamatan = $request->kecamatan;
        $dataPpks->langitude = $request->langitude;
        $dataPpks->longatitude = $request->longatitude;

        $dataPpks->save();

        return redirect()->back()->with('success', 'DataPpks updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataPpks = DataPpks::findOrFail($id);
        $dataPpks->delete();

        return redirect()->back()->with('success', 'DataPpks deleted successfully.');
    }
}

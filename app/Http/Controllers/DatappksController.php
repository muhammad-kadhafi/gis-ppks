<?php

namespace App\Http\Controllers;

use App\Models\DataPpks;
use App\Models\Jenis;
use App\Models\Terminasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $validatedData = $request->validate([
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
            'foto' => 'required',
            'langitude' => 'required',
            'longatitude' => 'required',
        ]);

        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('public/foto-ppks');
            // Hanya simpan nama file atau path relatif tanpa "public"
            $validatedData['foto'] = str_replace('public/', '', $validatedData['foto']);
        }

        DataPpks::create($validatedData);

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
            'foto' => 'nullable',
            'langitude' => 'required',
            'longatitude' => 'required',
        ]);

        $dataPpks = DataPpks::findOrFail($id);


        // Jika ada file foto yang diupload
        if ($request->file('foto')) {
            // Hapus foto lama jika ada
            if ($dataPpks->foto) {
                Storage::delete($dataPpks->foto);
            }

            // Simpan foto baru dengan path tanpa "public"
            $path = $request->file('foto')->store('public/foto-ppks');

            // Hanya simpan nama file atau path relatif tanpa "public"
            $dataPpks->foto = str_replace('public/', '', $path);
        }

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
        $dataPpks->langitude = $request->langitude; // Perbaiki nama menjadi 'latitude'
        $dataPpks->longatitude = $request->longatitude; // Perbaiki nama menjadi 'longitude'

        $dataPpks->save();

        return redirect()->back()->with('success', 'Data PPKS updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataPpks = DataPpks::findOrFail($id);

        // Hapus file foto jika ada
        if ($dataPpks->foto) {
            Storage::delete('public/' . $dataPpks->foto);
        }

        $dataPpks->delete();

        return redirect()->back()->with('success', 'Data PPKS deleted successfully.');
    }
}

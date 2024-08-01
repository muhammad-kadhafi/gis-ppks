<?php

namespace App\Http\Controllers;

use App\Models\DataPpks;
use Illuminate\Http\Request;

class SebaranController extends Controller
{
    public function index()
    {
        $ppks = DataPpks::with('Jenis', 'Terminasi')->get();
        $groupedByJenis = $ppks->groupBy('id_kriteria')->map(function ($group) {
            return [
                'count' => $group->count(),
                'jenis' => $group->first()->jenis->jenis // Ambil nama jenis dari salah satu item
            ];
        });
        return view('sebaran')->with(compact('ppks', 'groupedByJenis'));
    }
}

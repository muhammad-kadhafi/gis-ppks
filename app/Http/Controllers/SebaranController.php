<?php

namespace App\Http\Controllers;

use App\Models\DataPpks;
use Illuminate\Http\Request;

class SebaranController extends Controller
{
    public function index()
    {
        $ppks = DataPpks::with('Jenis')->get();
        return view('sebaran')->with(compact('ppks'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\DataPpks;
use App\Models\User;
use Illuminate\Http\Request;
use Mockery\Matcher\HasValue;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::count();
        $petugas = User::where('role', 2)->count();
        $ppks = DataPpks::where('id_terminasi', null)->count();
        $ppks1 = DataPpks::whereNotNull('id_terminasi')->count();
        return view('index')->with(compact('user', 'petugas', 'ppks', 'ppks1'));
    }
}

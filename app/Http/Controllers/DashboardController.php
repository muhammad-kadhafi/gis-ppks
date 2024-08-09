<?php

namespace App\Http\Controllers;

use App\Models\DataPpks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Matcher\HasValue;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::count();
        $petugas = User::where('role', 2)->count();
        $ppks = DataPpks::where('id_terminasi', null)->count();
        $ppks1 = DataPpks::whereNotNull('id_terminasi')->count();
        $oneWeekAgo = now()->subDays(7);
        $ppksWeekly = DataPpks::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', $oneWeekAgo)
            ->groupBy('created_at')
            ->get();
        $ppksPerKecamatan = DataPpks::select('kecamatan', DB::raw('count(*) as count'))
            ->groupBy('kecamatan')
            ->get();
        return view('index')->with(compact('user', 'petugas', 'ppks', 'ppks1', 'ppksWeekly', 'ppksPerKecamatan'));
    }
}

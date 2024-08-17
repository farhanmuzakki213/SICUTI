<?php

namespace App\Http\Controllers;

use App\Models\cuti;
use App\Models\pegawai;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function dashboard()
    {
        $roleUser = auth()->user()->roles->pluck('name')->implode(', ');
        $dataKaryawan = pegawai::where('jabatan_id', 4)->count();
        $dataCutiDiajukan = cuti::count();

        if ($roleUser == 'staff') {
            $dataCutiDitolak = cuti::where('s_staff', 'Ditolak')
                ->count();
            $dataCutiDiterima = cuti::where('s_staff', 'Diterima')->count();
        }
        if ($roleUser == 'assistant') {
            $dataCutiDitolak = cuti::where('s_staff', 'Ditolak')
                ->OrWhere('s_assistent', 'Ditolak')
                ->count();
            $dataCutiDiterima = cuti::where('s_assistent', 'Diterima')->count();
        }
        if ($roleUser == 'manager') {
            $dataCutiDitolak = cuti::where('s_staff', 'Ditolak')
                ->OrWhere('s_assistent', 'Ditolak')
                ->OrWhere('s_manager', 'Ditolak')
                ->count();
            $dataCutiDiterima = cuti::where('s_manager', 'Diterima')->count();
        }

        $dataCutiDiproses = $dataCutiDiajukan - ($dataCutiDiterima + $dataCutiDitolak);
        return view('admin.content.dashboard', compact('dataKaryawan', 'dataCutiDitolak', 'dataCutiDiterima', 'dataCutiDiproses'));
    }
}

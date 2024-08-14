<?php

namespace App\Http\Controllers;

use App\Models\cuti;
use App\Models\pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roleUser = auth()->user()->roles->pluck('name')->implode(', ');
        $loginUserId = Auth::user()->id;
        $dataPegawai = pegawai::where('user_id', $loginUserId)->first();
        // dd($loginUser);
        $statusColumn = null;
        if ($roleUser == 'employee') {
            $dataCutiKaryawan = cuti::where('pegawai_id', $dataPegawai->id_pegawai)->get();
        }
        if ($roleUser == 'staff') {
            $dataCutiKaryawan = cuti::all();
            $statusColumn = 's_staff';
        }
        if ($roleUser == 'assistant') {
            $dataCutiKaryawan = cuti::where('s_staff', 'Diterima')->get();
            $statusColumn = 's_assistent';
        }
        if ($roleUser == 'manager') {
            $dataCutiKaryawan = cuti::where('s_assistent', 'Diterima')->get();
            $statusColumn = 's_manager';
        }

        $workDaysTotal = 0;

        foreach ($dataCutiKaryawan as $data) {
            $startDate = Carbon::parse($data->tgl_mulai_cuti);
            $endDate = Carbon::parse($data->tgl_akhir_cuti);

            $workDays = 0;

            while ($startDate->lte($endDate)) {
                if (!$this->isHolidayOrWeekend($startDate)) {
                    $workDays++;
                }
                $startDate->addDay();
            }

            $data->workDaysTotal = $workDays; // Menyimpan total hari kerja pada objek $data
        }
        return view('admin.content.cuti.cutiKaryawan', compact('dataCutiKaryawan', 'statusColumn'));
    }

    function isHolidayOrWeekend($date)
    {
        $weekDay = $date->format('N');
        $year = date('Y');

        // Daftar hari libur nasional dengan format 'bulan-tanggal'
        $holidays = [
            '01-01', // Tahun Baru Masehi
            '02-10', // Contoh: Tahun Baru Imlek (ini contoh saja, sesuaikan dengan kalender)
            '03-22', // Hari Raya Nyepi (Tahun Baru Saka) - contoh tanggal
            '04-07', // Waisak (contoh tanggal)
            '05-01', // Hari Buruh Internasional
            '06-01', // Hari Lahir Pancasila
            '08-17', // Hari Kemerdekaan Indonesia
            '12-25', // Hari Raya Natal
            // Tambahkan lebih banyak tanggal dan sesuaikan dengan tahun
        ];


        // Cek apakah tanggal merupakan akhir pekan
        if ($weekDay >= 6) {
            return true;
        }

        // Cek apakah tanggal adalah hari libur nasional
        $dateString = $date->format('m-d');
        if (in_array($dateString, $holidays)) {
            return true;
        }

        return false;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.cuti.pengajuanCuti');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $sisaCuti = pegawai::where('user_id', Auth::user()->id)->first()->saldo_cuti;
        $startDate = Carbon::parse($request->mulaiCuti);
        $endDate = Carbon::parse($request->akhirCuti);

        $workDays = 0;

        while ($startDate->lte($endDate)) {
            if (!$this->isHolidayOrWeekend($startDate)) {
                $workDays++;
            }
            $startDate->addDay();
        }

        $totalCuti = $workDays;

        // dd($totalCuti, $sisaCuti);
        if ($sisaCuti < $totalCuti) {
            return redirect()->route('cuti.create')->with('error', 'Saldo Cuti anda tinggal ' . $sisaCuti . ' hari, saldo cuti tidak cukup untuk periode yang diajukan.');
        }
        $validator = Validator::make($request->all(), [
            'mulaiCuti' => 'required|date|after:today',
            'akhirCuti' => 'required|date|after:mulaiCuti',
            'keterangan' => 'required',
        ], [
            'mulaiCuti.required' => 'Tanggal mulai cuti harus diisi.',
            'mulaiCuti.date' => 'Tanggal mulai cuti harus berupa tanggal yang valid.',
            'mulaiCuti.after' => 'Tanggal mulai cuti harus paling lambat H-1 sebelum hari ini.',
            'akhirCuti.required' => 'Tanggal akhir cuti harus diisi.',
            'akhirCuti.date' => 'Tanggal akhir cuti harus berupa tanggal yang valid.',
            'akhirCuti.after' => 'Tanggal akhir cuti harus lebih besar dari tanggal mulai cuti.',
            'keterangan.required' => 'Keterangan harus diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        DB::beginTransaction();
        try {
            $userLogin = Auth::user()->id;
            $id_pegawai = pegawai::where('user_id', $userLogin)->first()->id_pegawai;
            $data = [
                'pegawai_id' => $id_pegawai,
                'tgl_mulai_cuti' => $request->mulaiCuti,
                'tgl_akhir_cuti' => $request->akhirCuti,
                'keterangan' => $request->keterangan,
            ];
            $sisaSaldoCuti = $sisaCuti - $totalCuti;
            $updateSaldoCuti = [
                'saldo_cuti' => $sisaSaldoCuti,
            ];
            cuti::create($data);
            $karyawan = pegawai::find($id_pegawai);
            if ($karyawan) {
                $karyawan->update($updateSaldoCuti);
            }
            DB::commit();
        } catch (\Throwable) {
            DB::rollback();
            return redirect()->route('cuti.create')->with('error', 'Gagal menyimpan data cuti.');
        }
        return redirect()->route('cuti')->with('success', 'Berhasil menyimpan data cuti.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $userRoles = auth()->user()->roles->pluck('name');

        // Tentukan kolom mana yang perlu diperbarui berdasarkan role pengguna
        $statusColumn = null;

        if ($userRoles->contains('staff')) {
            $statusColumn = 's_staff';
        } elseif ($userRoles->contains('assistant')) {
            $statusColumn = 's_assistent';
        } elseif ($userRoles->contains('manager')) {
            $statusColumn = 's_manager';
        }

        // Perbarui status hanya jika kolom status ditentukan
        if ($statusColumn) {
            if ($request->status == 'Ditolak') {
                $this->saldoCutiUpdate($id);
            }
            Cuti::where('id_cuti', $id)->update([$statusColumn => $request->status]);
            return redirect()->route('cuti')->with('success', 'Berhasil ubah status izin cuti.');
        }

        // Jika role tidak ditemukan, redirect dengan pesan error
        return redirect()->route('cuti')->with('error', 'Gagal ubah status izin cuti');
    }


    public function saldoCutiUpdate(string $id)
    {
        $karyawan = cuti::where('id_cuti', $id)->first();
        $sisaCuti = pegawai::where('user_id', $karyawan->pegawai_id)->first()->saldo_cuti;
        $startDate = Carbon::parse($karyawan->tgl_mulai_cuti);
        $endDate = Carbon::parse($karyawan->tgl_akhir_cuti);

        $workDays = 0;

        while ($startDate->lte($endDate)) {
            if (!$this->isHolidayOrWeekend($startDate)) {
                $workDays++;
            }
            $startDate->addDay();
        }

        $totalCuti = $workDays;
        $sisaSaldoCuti = $sisaCuti + $totalCuti;
        $updateSaldoCuti = [
            'saldo_cuti' => $sisaSaldoCuti,
        ];
        $karyawan = pegawai::find($karyawan->pegawai_id);
        if ($karyawan) {
            $karyawan->update($updateSaldoCuti);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $this->saldoCutiUpdate($id);
            $dataCutiKaryawan = cuti::where('id_cuti', $id)->first();

            if ($dataCutiKaryawan) {
                $dataCutiKaryawan->delete();
            }
            DB::commit();
        } catch (\Throwable) {
            DB::rollback();
            return redirect()->route('cuti.create')->with('error', 'Gagal menghapus data cuti.');
        }
        return redirect()->route('cuti')->with('success', 'Berhasil menghapus data cuti.');
    }
}

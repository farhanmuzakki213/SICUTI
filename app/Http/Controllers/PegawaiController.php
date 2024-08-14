<?php

namespace App\Http\Controllers;

use App\Models\divisi;
use App\Models\jabatan;
use App\Models\pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_karyawan = pegawai::where('jabatan_id', 4)->get();
        // dd($data_karyawan->toArray());
        return view('admin.content.karyawan', compact('data_karyawan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_user = User::all();
        $data_divisi = divisi::all();

        // dd(compact('data_user', 'data_divisi'));
        return view('admin.content.form.karyawanCreate', compact('data_user', 'data_divisi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'akunUser' => 'required',
            'divisi' => 'required',
            'nama' => 'required',
            'nip' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = [
            'user_id' => $request->akunUser,
            'divisi_id' => $request->divisi,
            'jabatan_id' => 4,
            'nip' => $request->nip,
            'nama' => $request->nama,
            'status' => 'aktif',
            'saldo_cuti' => 12,
        ];
        DB::beginTransaction();
        try {
            pegawai::create($data);
            $user = User::find($request->akunUser);
            if ($user) {
                $user->roles()->attach(4);
            }
            DB::commit();
        } catch (\Throwable) {
            DB::rollback();
            return redirect()->route('karyawan.create')->with('error', 'Gagal menyimpan data karyawan.');
        }
        return redirect()->route('karyawan')->with('success', 'Berhasil menyimpan data karyawan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        /* $data_dosen = Dosen::all();
        $data_jabatan_kbk = JabatanKbk::all();
        $data_jenis_kbk = JenisKbk::all();

        $detail_pengurus_kbk = pengurus_kbk::where('id_pengurus', $id)->first();

        return view('admin.content.admin.pengurus_kbk', compact('data_dosen', 'data_jabatan_kbk', 'data_jenis_kbk', 'detail_pengurus_kbk')); */
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $data_user = User::all();
        $data_divisi = divisi::all();
        $data_karyawan = pegawai::where('id_pegawai', $id)->with('r_divisi')->first();
        // dd(compact('data_user', 'data_divisi', 'data_karyawan'));
        return view('admin.content.form.karyawanUpdate', compact('data_user', 'data_divisi', 'data_karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'divisi' => 'required',
            'nama' => 'required',
            'status' => 'required',
            'nip' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = [
            'divisi_id' => $request->divisi,
            'nip' => $request->nip,
            'status' => $request->status,
            'nama' => $request->nama,
        ];
        $karyawan = pegawai::find($id);

        if ($karyawan) {
            $karyawan->update($data);
        }
        return redirect()->route('karyawan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request, string $id)
    {
        $data_pegawai = pegawai::where('id_pegawai', $id)->first();

        if ($data_pegawai) {
            $data_pegawai->delete();
        }
        return redirect()->route('karyawan');
    }
}

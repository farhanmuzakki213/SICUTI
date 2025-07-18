<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pegawai')->insert([
            [
                'user_id' => 1,
                'jabatan_id' => 1,
                'divisi_id' => 1,
                'atasan_id' => null, // Manager tidak punya atasan
                'nama' => 'John Doe',
                'nip' => 123456789,
                'status' => 'aktif',
                'saldo_cuti' => 12,
            ],
            [
                'user_id' => 2,
                'jabatan_id' => 2,
                'divisi_id' => 2,
                'atasan_id' => 1, // Assistant (Jane) lapor ke Manager (John)
                'nama' => 'Jane Smith',
                'nip' => 987654321,
                'status' => 'non-aktif',
                'saldo_cuti' => 8,
            ],
            [
                'user_id' => 3,
                'jabatan_id' => 3,
                'divisi_id' => 3,
                'atasan_id' => 2, // Staff (Alice) lapor ke Assistant (Jane)
                'nama' => 'Alice Johnson',
                'nip' => 123123123,
                'status' => 'aktif',
                'saldo_cuti' => 10,
            ],
            [
                'user_id' => 4,
                'jabatan_id' => 4,
                'divisi_id' => 1,
                'atasan_id' => 3, // Karyawan lapor ke Staff (Alice)
                'nama' => 'Karyawan1',
                'nip' => 123123123,
                'status' => 'aktif',
                'saldo_cuti' => 9,
            ],
            [
                'user_id' => 5,
                'jabatan_id' => 4,
                'divisi_id' => 3,
                'atasan_id' => 3, // Karyawan lapor ke Staff (Alice)
                'nama' => 'Karyawan2',
                'nip' => 123123123,
                'status' => 'aktif',
                'saldo_cuti' => 10,
            ],
            [
                'user_id' => 6,
                'jabatan_id' => 4,
                'divisi_id' => 3,
                'atasan_id' => 3, // Karyawan lapor ke Staff (Alice)
                'nama' => 'Karyawan3',
                'nip' => 123123123,
                'status' => 'aktif',
                'saldo_cuti' => 12,
            ],
        ]);
    }
}

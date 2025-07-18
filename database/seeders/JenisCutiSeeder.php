<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisCutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_cuti')->insert([
            [
                'nama_cuti' => 'Cuti Tahunan',
                'potong_saldo_tahunan' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_cuti' => 'Cuti Sakit (dengan surat dokter)',
                'potong_saldo_tahunan' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_cuti' => 'Cuti Melahirkan',
                'potong_saldo_tahunan' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_cuti' => 'Cuti Pendampingan Istri Melahirkan',
                'potong_saldo_tahunan' => false, // Sesuai kebijakan perusahaan
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_cuti' => 'Cuti Alasan Penting (Keluarga meninggal, dll)',
                'potong_saldo_tahunan' => true, // Sesuai kebijakan perusahaan
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

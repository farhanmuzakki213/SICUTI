<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jabatan')->insert([
            ['nama_jabatan' => 'Manager'],
            ['nama_jabatan' => 'Staff'],
            ['nama_jabatan' => 'Assistant'],
            ['nama_jabatan' => 'Karyawan'],
        ]);
    }
}

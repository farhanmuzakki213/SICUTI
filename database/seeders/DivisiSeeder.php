<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('divisi')->insert([
            [
                'nama_divisi' => 'IT',
                'deskripsi' => 'Information Technology Division'
            ],
            [
                'nama_divisi' => 'HR',
                'deskripsi' => 'Human Resources Division'
            ],
            [
                'nama_divisi' => 'Finance',
                'deskripsi' => 'Finance and Accounting Division'
            ],
        ]);
    }
}

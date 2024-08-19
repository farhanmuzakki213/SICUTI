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
                'nama_divisi' => 'Divisi 1',
                'deskripsi' => 'Div-1 KNB'
            ],
            [
                'nama_divisi' => 'Divisi 2',
                'deskripsi' => 'Div-2 KNB'
            ],
            [
                'nama_divisi' => 'Divisi 3',
                'deskripsi' => 'Div-3 KNB'
            ],
            [
                'nama_divisi' => 'Divisi 4',
                'deskripsi' => 'Div-4 KNB'
            ],
            [
                'nama_divisi' => 'Divisi 5',
                'deskripsi' => 'Div-5 KNT'
            ],
            [
                'nama_divisi' => 'Divisi 6',
                'deskripsi' => 'Div-6 KNT'
            ],
            [
                'nama_divisi' => 'Divisi 7',
                'deskripsi' => 'Div-7 KNT'
            ],
            [
                'nama_divisi' => 'Divisi 8',
                'deskripsi' => 'Div-8 KNT'
            ],
        ]);
    }
}

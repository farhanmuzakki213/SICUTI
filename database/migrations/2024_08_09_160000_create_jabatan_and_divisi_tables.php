<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Membuat tabel jabatan
        Schema::create('jabatan', function (Blueprint $table) {
            $table->id('id_jabatan');
            $table->string('nama_jabatan');
        });

        // Membuat tabel divisi
        Schema::create('divisi', function (Blueprint $table) {
            $table->id('id_divisi');
            $table->string('nama_divisi');
            $table->text('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Menghapus tabel jabatan dan divisi
        Schema::dropIfExists('jabatan');
        Schema::dropIfExists('divisi');
    }
};

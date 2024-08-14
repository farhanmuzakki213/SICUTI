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
        Schema::create('cuti', function (Blueprint $table) {
            $table->id('id_cuti');
            $table->unsignedBigInteger('pegawai_id');
            $table->date('tgl_mulai_cuti');
            $table->date('tgl_akhir_cuti');
            $table->string('keterangan');
            $table->enum('s_staff', ['Diajukan', 'Ditolak', 'Diterima']); // Kolom enum untuk status staff
            $table->enum('s_assistent', ['Diajukan', 'Ditolak', 'Diterima']); // Kolom enum untuk status asistent
            $table->enum('s_manager', ['Diajukan', 'Ditolak', 'Diterima']); // Kolom enum untuk status manager
            $table->timestamps();

            // Menambahkan foreign key constraints
            $table->foreign('pegawai_id')->references('id_pegawai')->on('pegawai')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuti');
    }
};

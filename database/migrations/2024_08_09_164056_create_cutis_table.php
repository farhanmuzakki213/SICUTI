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
            $table->unsignedBigInteger('jenis_cuti_id'); // Foreign key untuk jenis cuti
            $table->date('tgl_mulai_cuti');
            $table->date('tgl_akhir_cuti');
            $table->text('keterangan'); // Keterangan dari pemohon

            // Kolom status yang lebih dinamis
            $table->enum('status', ['Diajukan', 'Diproses', 'Disetujui', 'Ditolak', 'Revisi'])->default('Diajukan');

            // ID penyetuju saat ini (atasan)
            $table->unsignedBigInteger('approver_id')->nullable();

            // Keterangan dari approver
            $table->text('review_keterangan')->nullable();

            $table->timestamps();

            $table->foreign('pegawai_id')->references('id_pegawai')->on('pegawai')->onDelete('cascade');
            $table->foreign('jenis_cuti_id')->references('id_jenis_cuti')->on('jenis_cuti');
            $table->foreign('approver_id')->references('id')->on('users')->onDelete('set null');
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

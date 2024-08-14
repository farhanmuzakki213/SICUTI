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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id('id_pegawai');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('jabatan_id');
            $table->unsignedBigInteger('divisi_id');
            $table->string('nama');
            $table->bigInteger('nip');
            $table->enum('status', ['aktif', 'non-aktif']);
            $table->bigInteger('saldo_cuti');
            $table->timestamps();

            // Menambahkan foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('jabatan_id')->references('id_jabatan')->on('jabatan')->onDelete('cascade');
            $table->foreign('divisi_id')->references('id_divisi')->on('divisi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
};

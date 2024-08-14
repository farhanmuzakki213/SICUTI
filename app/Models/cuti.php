<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cuti extends Model
{
    use HasFactory;
    protected $fillable = [
        'pegawai_id', 'tgl_mulai_cuti', 'tgl_akhir_cuti', 'keterangan', 's_staff', 's_assistent', 's_manager', 'created_at', 'updated_at'
    ];
    protected $table = 'cuti';
    protected $primaryKey = 'id_cuti';

    public function r_pegawai(){
        return $this->belongsTo(pegawai::class, 'pegawai_id','id_pegawai');
    }
}

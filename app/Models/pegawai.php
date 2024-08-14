<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'jabatan_id', 'divisi_id', 'nama', 'nip', 'status', 'saldo_cuti', 'created_at', 'updated_at'
    ];
    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';

    public function r_jabatan(){
        return $this->belongsTo(jabatan::class, 'jabatan_id','id_jabatan');
    }

    public function r_divisi(){
        return $this->belongsTo(divisi::class, 'divisi_id','id_divisi');
    }

    public function r_akun(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
}

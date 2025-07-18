<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';

    protected $fillable = [
        'user_id',
        'jabatan_id',
        'divisi_id',
        'atasan_id', // Kolom baru
        'nama',
        'nip',
        'status',
        'saldo_cuti',
    ];

    /**
     * Get the user that owns the Pegawai.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the atasan (superior) for the Pegawai.
     * This returns the User model of the superior.
     */
    public function atasan()
    {
        return $this->belongsTo(User::class, 'atasan_id', 'id');
    }

    /**
     * Get all of the cuti for the Pegawai.
     */
    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'pegawai_id', 'id_pegawai');
    }

    /**
     * Get the divisi for the Pegawai.
     */
    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id', 'id_divisi');
    }

    /**
     * Get the jabatan for the Pegawai.
     */
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id_jabatan');
    }
}

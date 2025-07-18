<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'cuti';
    protected $primaryKey = 'id_cuti';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pegawai_id',
        'jenis_cuti_id',
        'tgl_mulai_cuti',
        'tgl_akhir_cuti',
        'keterangan',
        'status',
        'approver_id',
        'review_keterangan',
    ];

    /**
     * Get the pegawai that owns the Cuti.
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id_pegawai');
    }

    /**
     * Get the jenisCuti that owns the Cuti.
     */
    public function jenisCuti()
    {
        return $this->belongsTo(JenisCuti::class, 'jenis_cuti_id', 'id_jenis_cuti');
    }

    /**
     * Get the user (approver) that is assigned to this Cuti.
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id', 'id');
    }
}

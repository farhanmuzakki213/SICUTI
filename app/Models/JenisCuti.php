<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisCuti extends Model
{
    use HasFactory;

    protected $table = 'jenis_cuti';
    protected $primaryKey = 'id_jenis_cuti';

    protected $fillable = [
        'nama_cuti',
        'potong_saldo_tahunan',
    ];

    /**
     * Get all of the cuti for the JenisCuti
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'jenis_cuti_id', 'id_jenis_cuti');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class divisi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_divisi', 'deskripsi'
    ];
    protected $table = 'divisi';
    protected $primaryKey = 'id_divisi';
    public $timestamps = false;
}

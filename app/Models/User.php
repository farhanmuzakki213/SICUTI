<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function pegawai(): HasOne
    {
        return $this->hasOne(Pegawai::class, 'user_id', 'id');
    }

    /**
     * Get all of the subordinates for the user.
     */
    public function bawahan(): HasMany
    {
        return $this->hasMany(Pegawai::class, 'atasan_id', 'id');
    }

    /**
     * Check if the user is currently on leave.
     */
    public function isOnLeave(): bool
    {
        // Pastikan relasi pegawai ada sebelum mengaksesnya
        return $this->pegawai && Cuti::where('pegawai_id', $this->pegawai->id_pegawai)
            ->where('status', 'Disetujui')
            ->whereDate('tgl_mulai_cuti', '<=', now())
            ->whereDate('tgl_akhir_cuti', '>=', now())
            ->exists();
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// Tambahkan HasRoles
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Siswa;

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
        'role',
        'parent_id',
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
    ];

    /**
     * Get all kasus for this siswa.
     */
    public function kasus(): HasMany
    {
        return $this->hasMany(Kasus::class, 'siswa_id');
    }

    /**
     * Get the siswa record for this user (if any).
     */
    public function siswa(): HasOne
    {
        return $this->hasOne(Siswa::class, 'user_id');
    }

    /**
     * Get all kasus recorded by this guru.
     */
    public function kasusAsGuru(): HasMany
    {
        return $this->hasMany(Kasus::class, 'guru_id');
    }

    /**
     * Get total poin for this siswa.
     */
    public function getTotalPoin()
    {
        // If this user has a siswa record, use its helper; otherwise try to sum from kasus relation.
        if ($this->relationLoaded('siswa') || $this->siswa) {
            try {
                return $this->siswa->getTotalPoin();
            } catch (\Throwable $e) {
                // fallback to direct sum if something unexpected occurs
            }
        }

        // Fallback: try summing a 'poin' column if present on related kasus
        try {
            return $this->kasus()->sum('poin');
        } catch (\Throwable $e) {
            return 0;
        }
    }

    /**
     * Cek apakah pengguna memiliki peran tertentu.
     *
     * @param  string|array  $roles
     * @return bool
     */
    public function hasRole($roles)
    {
        // Jika peran pengguna kosong, kembalikan false
        if (empty($this->role)) {
            return false;
        }

        // Ubah peran yang diminta menjadi array jika string
        if (is_string($roles)) {
            return $this->role === $roles;
        }

        // Cek apakah peran pengguna ada di dalam array peran yang diminta
        return in_array($this->role, $roles);
    }
}

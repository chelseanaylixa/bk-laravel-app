<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// Tambahkan HasRoles
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

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

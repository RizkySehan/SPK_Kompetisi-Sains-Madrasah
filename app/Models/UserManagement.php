<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserManagement extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    // Sesuaikan fillable dengan kolom yang diperlukan
    protected $fillable = [
        'name',      // harus 'name' karena di view pakai $user->name
        'email',
        'password',
        'role',
        'active',    // untuk status aktif/tidak aktif
    ];

    // Sembunyikan password dan token dari serialisasi JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Cast kolom ke tipe data yang tepat
    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'boolean',  // agar $user->active menjadi boolean
    ];

    /**
     * Mutator agar password otomatis di-hash saat diset
     */
    public function setPasswordAttribute($value)
    {
        // Jika password sudah di-hash, jangan hash ulang
        if (strlen($value) !== 60 || !preg_match('/^\$2y\$/', $value)) {
            $this->attributes['password'] = bcrypt($value);
        } else {
            $this->attributes['password'] = $value;
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'phone',
    ];
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}

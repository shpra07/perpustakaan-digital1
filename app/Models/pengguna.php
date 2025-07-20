<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'password',
    ];
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
} 

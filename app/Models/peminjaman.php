<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = [
        'buku_id',
        'anggota_id',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'pengguna_id',
    ];
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }
}

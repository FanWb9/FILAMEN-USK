<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Buku extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'Nama_barang',
        'Kategori',
        'quantity',
        'Id_barang',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class peminjaman extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'Nama_peminjam',
        'Nama_barang',
        'quantity',
        'buku_id',
        'status',
    ];
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
    public static function boot()
    {
        parent::boot();

        static::creating(function ($peminjaman) {
            $buku = Buku::find($peminjaman->buku_id);
            if ($buku && $buku->quantity >= $peminjaman->quantity) {
                $buku->decrement('quantity', $peminjaman->quantity);
            } else {
                throw new \Exception("Stok tidak cukup!");
            }
        });

        static::updating(function ($peminjaman) {
            if ($peminjaman->isDirty('status') && $peminjaman->status == 'dikembalikan') {
                $buku = Buku::find($peminjaman->buku_id);
                if ($buku) {
                    $buku->increment('quantity', $peminjaman->quantity);
                }
            }
        });
    }
}

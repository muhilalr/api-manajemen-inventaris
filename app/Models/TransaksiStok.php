<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiStok extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_produk',
        'tipe',
        'jumlah',
        'stok_sebelum',
        'stok_sesudah',
        'catatan',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}

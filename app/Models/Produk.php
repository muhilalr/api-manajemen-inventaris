<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kategori',
        'kode_produk',
        'name',
        'stok',
        'unit',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function transaksiStok()
    {
        return $this->hasMany(TransaksiStok::class, 'id_produk');
    }
}

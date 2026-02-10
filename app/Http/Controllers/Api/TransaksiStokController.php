<?php

namespace App\Http\Controllers\Api;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\TransaksiStok;
use App\Http\Controllers\Controller;

class TransaksiStokController extends Controller
{
    public function store(Request $request)
    {
        $produk = Produk::findOrFail($request->id_produk);

        $stokSebelum = $produk->stok;

        if ($request->tipe === 'masuk') {
            $produk->stok += $request->jumlah;
        } else {
            if ($produk->stok < $request->jumlah) {
                return response()->json(['message' => 'Stok tidak cukup'], 400);
            }
            $produk->stok -= $request->jumlah;
        }

        $produk->save();

        TransaksiStok::create([
            'id_produk' => $produk->id,
            'tipe' => $request->tipe,
            'jumlah' => $request->jumlah,
            'stok_sebelum' => $stokSebelum,
            'stok_sesudah' => $produk->stok,
            'catatan' => $request->catatan
        ]);

        return response()->json(['message' => 'Transaksi berhasil']);
    }
}

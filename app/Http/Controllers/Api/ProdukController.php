<?php

namespace App\Http\Controllers\Api;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Produk::with('kategori')->latest()->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori'   => 'required|exists:kategoris,id',
            'kode_produk'   => 'required|unique:produks,kode_produk',
            'name'          => 'required|string',
            'stok'          => 'nullable|integer|min:0',
            'unit'          => 'required|string'
        ]);

        $produk = Produk::create([
            'id_kategori' => $validated['id_kategori'],
            'kode_produk' => $validated['kode_produk'],
            'name'        => $validated['name'],
            'stok'        => $validated['stok'] ?? 0,
            'unit'        => $validated['unit'],
        ]);

        return response()->json([
            'message' => 'Produk berhasil ditambahkan',
            'data'    => $produk
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produk = Produk::with(['kategori', 'transaksi'])->findOrFail($id);

        return response()->json($produk);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produk = Produk::findOrFail($id);

        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategoris,id',
            'kode_produk' => 'required|unique:produks,kode_produk,' . $produk->id,
            'name'        => 'required|string',
            'unit'        => 'required|string'
        ]);

        $produk->update($validated);

        return response()->json([
            'message' => 'Produk berhasil diupdate',
            'data'    => $produk
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return response()->json([
            'message' => 'Produk berhasil dihapus'
        ]);
    }
}

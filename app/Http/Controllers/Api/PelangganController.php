<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::all();

        return response()->json([
            'success' => true,
            'data' => $pelanggans
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_telepon' => 'required|string|max:20',
            'catatan_khusus' => 'nullable|string',
        ]);

        $pelanggan = Pelanggan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil ditambahkan',
            'data' => $pelanggan
        ], 200);
    }

    public function show(Pelanggan $pelanggan)
    {
        return response()->json([
            'success' => true,
            'data' => $pelanggan
        ]);
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'alamat' => 'nullable|string',
            'no_telepon' => 'sometimes|required|string|max:20',
            'catatan_khusus' => 'nullable|string',
        ]);

        $pelanggan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil diperbarui',
            'data' => $pelanggan
        ]);
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil dihapus'
        ], 200);
    }
}
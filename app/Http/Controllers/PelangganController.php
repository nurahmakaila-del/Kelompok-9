<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::latest()->get();
        return view('pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_telepon' => 'required|string|max:20|unique:pelanggans',
            'catatan_khusus' => 'nullable|string',
        ]);
        Pelanggan::create($data);
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan ditambahkan');
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_telepon' => 'required|string|max:20|unique:pelanggans,no_telepon,' . $pelanggan->id,
            'catatan_khusus' => 'nullable|string',
        ]);
        $pelanggan->update($data);
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan diperbarui');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan dihapus');
    }
}
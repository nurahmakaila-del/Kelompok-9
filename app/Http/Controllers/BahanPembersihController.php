<?php

namespace App\Http\Controllers;

use App\Models\BahanPembersih;
use Illuminate\Http\Request;

class BahanPembersihController extends Controller
{
    public function index()
    {
        $bahanPembersih = BahanPembersih::all();

        return view('bahan-pembersih.index', compact('bahanPembersih'));
    }

    public function create()
    {
        return view('bahan-pembersih.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bahan' => 'required',
            'merek' => 'nullable',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required',
        ]);

        BahanPembersih::create($request->all());

        return redirect('/bahan-pembersih')
            ->with('success', 'Bahan pembersih berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $bahanPembersih = BahanPembersih::findOrFail($id);

        return view('bahan-pembersih.edit', compact('bahanPembersih'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bahan' => 'required',
            'merek' => 'nullable',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required',
        ]);

        $bahanPembersih = BahanPembersih::findOrFail($id);

        $bahanPembersih->update($request->all());

        return redirect('/bahan-pembersih')
            ->with('success', 'Bahan pembersih berhasil diperbarui.');
    }

    public function destroy($id)
    {
        BahanPembersih::findOrFail($id)->delete();

        return redirect('/bahan-pembersih')
            ->with('success', 'Bahan pembersih berhasil dihapus.');
    }
}

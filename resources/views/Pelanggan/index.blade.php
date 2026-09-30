@extends('pelanggan.layout')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Pelanggan</h3>
    <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">+ Tambah</a>
</div>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered">
    <thead>
        <tr><th>No</th><th>Nama</th><th>Alamat</th><th>No. Telepon</th><th>Catatan Khusus</th><th>Aksi</th></tr>
    </thead>
    <tbody>
        @forelse($pelanggans as $p)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->alamat }}</td>
            <td>{{ $p->no_telepon }}</td>
            <td>{{ $p->catatan_khusus }}</td>
            <td>
                <a href="{{ route('pelanggan.edit', $p) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('pelanggan.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center">Belum ada data</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
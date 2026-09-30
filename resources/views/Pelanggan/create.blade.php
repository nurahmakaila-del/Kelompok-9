@extends('pelanggan.layout')
@section('content')
<h3>Tambah Pelanggan</h3>
<form action="{{ route('pelanggan.store') }}" method="POST">
    @csrf
    @include('pelanggan._form')
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
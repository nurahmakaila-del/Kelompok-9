@extends('pelanggan.layout')
@section('content')
<h3>Edit Pelanggan</h3>
<form action="{{ route('pelanggan.update', $pelanggan) }}" method="POST">
    @csrf
    @method('PUT')
    @include('pelanggan._form')
    <button class="btn btn-primary">Perbarui</button>
    <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
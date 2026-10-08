<div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control" value="{{ old('nama', $pelanggan->nama ?? '') }}">
    @error('nama')<small class="text-danger">{{ $message }}</small>@enderror
</div>
<div class="mb-3">
    <label class="form-label">Alamat</label>
    <textarea name="alamat" class="form-control">{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>
    @error('alamat')<small class="text-danger">{{ $message }}</small>@enderror
</div>
<div class="mb-3">
    <label class="form-label">No. Telepon</label>
    <input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon', $pelanggan->no_telepon ?? '') }}">
    @error('no_telepon')<small class="text-danger">{{ $message }}</small>@enderror
</div>
<div class="mb-3">
    <label class="form-label">Catatan Khusus Pakaian</label>
    <textarea name="catatan_khusus" class="form-control">{{ old('catatan_khusus', $pelanggan->catatan_khusus ?? '') }}</textarea>
    @error('catatan_khusus')<small class="text-danger">{{ $message }}</small>@enderror
</div>
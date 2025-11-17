@extends('app')

@section('content')
<div class="container">
    <h1>Edit Meja</h1>

    <form action="{{ route('admin.meja.update', $meja->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Meja</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $meja->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="harga_per_jam" class="form-label">Harga per Jam</label>
            <input type="number" name="harga_per_jam" id="harga_per_jam" class="form-control" value="{{ old('harga_per_jam', $meja->harga_per_jam) }}" required>
        </div>

        <div class="mb-3">
            <label for="asal" class="form-label">Asal Meja</label>
            <select name="asal" id="asal" class="form-control" required>
                <option value="vip" {{ old('asal', $meja->asal) == 'vip' ? 'selected' : '' }}>VIP</option>
                <option value="regular" {{ old('asal', $meja->asal) == 'regular' ? 'selected' : '' }}>Regular</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi', $meja->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            @if ($meja->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $meja->gambar) }}" alt="Gambar Meja" width="150">
                </div>
            @endif
            <input type="file" name="gambar" id="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection

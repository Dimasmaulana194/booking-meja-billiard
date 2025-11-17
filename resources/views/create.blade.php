@extends('app')

@section('content')
<div class="container">
    <h1>Tambah Meja</h1>

    <form action="{{ route('admin.meja.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Meja</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="harga_per_jam" class="form-label">Harga per Jam</label>
            <input type="number" name="harga_per_jam" id="harga_per_jam" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="asal" class="form-label">Asal Meja</label>
            <select name="asal" id="asal" class="form-control" required>
                <option value="vip">VIP</option>
                <option value="regular">Regular</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

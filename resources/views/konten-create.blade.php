@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Konten</h2>

    <form action="{{ route('konten.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('konten.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

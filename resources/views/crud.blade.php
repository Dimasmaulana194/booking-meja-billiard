@extends('app')

@section('content')
<div class="container">
    <h1 class="my-4">Daftar Meja</h1>

    {{-- Tombol tambah meja --}}
    <a href="{{ route('admin.meja.create') }}" class="btn btn-success mb-3">+ Tambah Meja</a>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabel daftar meja --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Harga/Jam</th>
                    <th>Asal</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mejas as $meja)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $meja->nama }}</td>
                    <td>Rp {{ number_format($meja->harga_per_jam, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge {{ $meja->asal === 'vip' ? 'bg-warning text-dark' : 'bg-secondary' }}">
                            {{ strtoupper($meja->asal) }}
                        </span>
                    </td>
                    <td>{{ $meja->deskripsi }}</td>
                    <td>
                        @if($meja->gambar)
                            <img src="{{ asset('storage/'.$meja->gambar) }}" alt="Gambar Meja" width="100">
                        @else
                            <span class="text-muted fst-italic">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.meja.edit', $meja->id) }}" class="btn btn-sm btn-primary mb-1">Edit</a>
                        <form action="{{ route('admin.meja.destroy', $meja->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus meja ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada data meja.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

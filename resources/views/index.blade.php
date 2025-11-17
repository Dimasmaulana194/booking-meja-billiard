{{-- resources/views/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin - Bolo Center</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .table thead th { background-color: #007bff; color: white; }
        .table tbody tr:hover { background-color: #f8f9fa; }
        .navbar { margin-bottom: 20px; }
    </style>
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Bolo Center Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.meja.index') }}">Manajemen Meja</a>
                    </li>
                </ul>
                <form action="{{ route('logout') }}" method="POST" class="d-flex">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        {{-- Notifikasi --}}
        @if(session('success'))
            <script>Swal.fire('Sukses!', '{{ session('success') }}', 'success');</script>
        @endif
        @if(session('error'))
            <script>Swal.fire('Error!', '{{ session('error') }}', 'error');</script>
        @endif

        <h1 class="mb-4">Dashboard Admin</h1>

        {{-- Form Pencarian Gabungan --}}
        <form action="{{ route('admin.dashboard') }}" method="GET" class="row g-3 mb-5">
            <div class="col-md-3">
                <input type="text" name="search_user" class="form-control" placeholder="Cari user..." value="{{ request('search_user') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="search_transaksi" class="form-control" placeholder="Cari order atau nama..." value="{{ request('search_transaksi') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">-- Semua Status --</option>
                    <option value="pending"   {{ request('status')=='pending'   ? 'selected':'' }}>Belum Bayar</option>
                    <option value="completed" {{ request('status')=='completed' ? 'selected':'' }}>Sudah Bayar</option>
                    <option value="cancelled" {{ request('status')=='cancelled' ? 'selected':'' }}>Dibatalkan</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">Filter</button>
            </div>
        </form>

        {{-- Tabel User --}}
        @isset($users)
        <div class="card mb-5">
            <div class="card-header bg-info text-white">Daftar User</div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>ID</th><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>
                                <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user?')" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">Tidak ada data user.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $users->withQueryString()->links() }}
            </div>
        </div>
        @endisset

        {{-- Tabel Transaksi --}}
        <div class="card">
            <div class="card-header bg-warning text-dark">Daftar Transaksi</div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Nama User</th>
                            <th>Meja</th>
                            <th>Total Harga</th> {{-- Tambahan --}}
                            <th>Status</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $trx)
                        <tr>
                            <td>{{ optional($trx->user)->name ?? '-' }}</td>
                            <td>{{ optional($trx->meja)->nama ?? '-' }}</td>
                            <td>Rp {{ number_format($trx->total_harga ?? 0, 0, ',', '.') }}</td> {{-- Tambahan --}}
                            <td>
                                @if(in_array($trx->status, ['capture', 'settlement', 'completed']))
                                    <span class="badge bg-success">Sudah Bayar</span>
                                @elseif(in_array($trx->status, ['pending']))
                                    <span class="badge bg-danger">Belum Bayar</span>
                                @elseif(in_array($trx->status, ['cancel', 'cancelled', 'expire', 'expired', 'failure']))
                                    <span class="badge bg-secondary">Kadaluarsa / Dibatalkan</span>
                                @else
                                    <span class="badge bg-warning text-dark">{{ ucfirst($trx->status) }}</span>
                                @endif
                            </td>
                            
                            <td>{{ $trx->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">Tidak ada transaksi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- <div class="card-footer text-center">
                {{ $transaksis->withQueryString()->links() }}
            </div> --}}
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

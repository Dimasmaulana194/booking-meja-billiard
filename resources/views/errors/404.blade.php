@extends('app') {{-- atau layout sesuai yang kamu pakai --}}

@section('content')
    <div class="text-center mt-5">
        <h1>404</h1>
        <p>Halaman tidak ditemukan.</p>
        <a href="{{ route('beranda') }}" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
@endsection

<!-- views/pembayaran.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pembayaran - Bolo Center</title>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { background: linear-gradient(135deg, #ff0000 0%, #f3baba 100%); min-height: 100vh; padding: 20px; }
        .container { background-color: rgba(255, 255, 255, 0.9); padding: 30px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .total { font-size: 1.5rem; font-weight: bold; margin-top: 20px; }
        .btn-bayar, .btn-kembali { padding: 12px 25px; border-radius: 5px; transition: background-color 0.3s ease; }
        .btn-bayar { background-color: #0004ff; color: white; border: none; }
        .btn-bayar:hover { background-color: #0033cc; }
        .btn-kembali { background-color: #6c757d; color: white; border: none; margin-right: 15px; }
        .btn-kembali:hover { background-color: #5a6268; }
        .btn-jam { background-color: #f8f9fa; border: 1px solid #ccc; padding: 5px 10px; border-radius: 5px; cursor: pointer; }
        .btn-jam:hover { background-color: #e2e6ea; }
        .form-control { border-radius: 10px; }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>{{ $meja['nama'] }}</h2>
            <p>Meja billiard berkualitas tinggi dengan ruangan nyaman dan pencahayaan ideal.</p>
            <p>Harga per jam: <strong>Rp {{ number_format($meja['harga_per_jam'], 0, ',', '.') }}</strong></p>

            <form id="formPembayaran">
                @csrf
                <input type="hidden" name="meja_id" value="{{ $meja['id'] }}">
                <input type="hidden" name="asal" value="{{ $meja['asal'] }}">
                <input type="hidden" name="harga" id="inputHarga" value="{{ $meja['harga_per_jam'] }}">
                <input type="hidden" name="jumlah_jam" id="inputJumlahJam" value="1">

                <div class="mt-4">
                    <label for="jumlah-jam">Jumlah Jam:</label>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn-jam" id="kurang-jam">-</button>
                        <input type="number" id="jumlah-jam" name="jumlah_jam_display" value="1" min="1" step="1" class="form-control mx-2" style="width: 80px;" readonly>
                        <button type="button" class="btn-jam" id="tambah-jam">+</button>
                    </div>
                </div>

                <div class="total mt-4">
                    Total: <span id="total-harga">Rp {{ number_format($meja['harga_per_jam'], 0, ',', '.') }}</span>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ $meja['asal'] === 'vip' ? route('meja-vip') : route('meja-regular') }}" class="btn btn-kembali">Kembali</a>
                    <button type="submit" class="btn btn-bayar">Bayar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('formPembayaran').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    fetch("{{ route('pembayaran.simpan') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // Panggil Snap setelah data disimpan
            fetch("{{ route('pembayaran.show', ['id' => $meja->id, 'harga' => $meja->harga_per_jam, 'asal' => $meja->asal]) }}")
                .then(res => res.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const snapToken = doc.querySelector('script[data-client-key]').dataset.snapToken || "{{ $snapToken }}";

                    window.snap.pay(snapToken, {
                        onSuccess: function(result) {
                            window.location.href = "{{ route('pembayaran.sukses') }}";
                        },
                        onPending: function(result) {
                            Swal.fire('Menunggu Pembayaran', 'Silakan selesaikan pembayaran Anda.', 'info');
                        },
                        onError: function(result) {
                            Swal.fire('Gagal', 'Terjadi kesalahan dalam pembayaran.', 'error');
                        }
                    });
                });
        } else {
            Swal.fire('Gagal', data.message || 'Gagal menyimpan transaksi.', 'error');
        }
    })
    .catch(error => {
        console.error(error);
        Swal.fire('Error', 'Terjadi kesalahan di server.', 'error');
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const hargaPerJam = parseInt(document.getElementById('inputHarga').value);
    const inputJumlahJam = document.getElementById('jumlah-jam');
    const inputJumlahJamHidden = document.getElementById('inputJumlahJam');
    const totalHargaEl = document.getElementById('total-harga');

    document.getElementById('kurang-jam').addEventListener('click', function () {
        let jumlah = parseInt(inputJumlahJam.value);
        if (jumlah > 1) {
            jumlah--;
            updateJumlah(jumlah);
        }
    });

    document.getElementById('tambah-jam').addEventListener('click', function () {
        let jumlah = parseInt(inputJumlahJam.value);
        jumlah++;
        updateJumlah(jumlah);
    });

    function updateJumlah(jumlah) {
        inputJumlahJam.value = jumlah;
        inputJumlahJamHidden.value = jumlah;
        let total = hargaPerJam * jumlah;
        totalHargaEl.textContent = 'Rp ' + total.toLocaleString('id-ID');
    }
});
</script>
</body>
</html>

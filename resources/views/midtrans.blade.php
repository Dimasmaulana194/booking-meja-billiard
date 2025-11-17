<!-- resources/views/midtrans.blade.php -->

<!-- Midtrans Snap.js -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function showMidtransPopup(snapToken) {
        if (!snapToken) {
            Swal.fire({
                icon: 'error',
                title: 'Token Tidak Tersedia',
                text: 'Gagal mendapatkan token pembayaran. Silakan coba lagi.',
            });
            return;
        }

        // Tampilkan pop-up pembayaran Midtrans
        window.snap.pay(snapToken, {
            onSuccess: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Pembayaran Berhasil!',
                    text: 'Transaksi telah berhasil diproses.',
                }).then(() => {
                    window.location.href = "{{ url('/pembayaran/sukses') }}";
                });
            },
            onPending: function(result) {
                Swal.fire({
                    icon: 'info',
                    title: 'Menunggu Pembayaran',
                    text: 'Pembayaran Anda sedang diproses. Harap selesaikan transaksi.',
                });
            },
            onError: function(result) {
                Swal.fire({
                    icon: 'error',
                    title: 'Pembayaran Gagal',
                    text: 'Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.',
                });
            },
            onClose: function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pembayaran Dibatalkan',
                    text: 'Anda menutup pop-up tanpa menyelesaikan pembayaran.',
                });
            }
        });
    }
</script>

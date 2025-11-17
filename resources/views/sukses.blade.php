<!-- resources/views/pembayaran/sukses.blade.php -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #e0ffe0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .success-box {
            background: white;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="success-box">
        <h1 class="text-success">🎉 Pembayaran Berhasil!</h1>
        <p>Terima kasih telah melakukan pembayaran di <strong>Bolo Center</strong>.</p>
        <a href="{{ route('beranda') }}" class="btn btn-success mt-3">Kembali ke Beranda</a>
    </div>
</body>
</html>

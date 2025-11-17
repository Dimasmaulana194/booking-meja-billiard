<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meja VIP - Bolo Center</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        /* Custom CSS untuk tambahan styling */
        body {
            background: linear-gradient(135deg, #2f00ff 0%, #ff00ee 100%);
            min-height: 100vh;
            padding: 20px;
            font-family: 'Arial', sans-serif;
        }

        .navbar {
            background-color: #5f1c1c;
            padding: 10px;
        }

        .navbar a {
            margin-right: 15px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .navbar a:hover {
            color: #ffcc00; /* Warna saat hover */
        }

        .container {
            padding: 20px;
        }

        h1 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: white;
            text-align: center;
        }

        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: rgba(255, 255, 255, 0.9);
            margin-bottom: 20px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 0.85rem;
            color: #555;
            margin-bottom: 10px;
        }

        .price {
            font-size: 1rem;
            font-weight: bold;
            color: #000;
            margin-bottom: 10px;
        }

        .btn-detail {
            background-color: #0004ff;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            font-size: 0.85rem;
            transition: background-color 0.3s ease;
        }

        .btn-detail:hover {
            background-color: #0033cc;
        }

        /* Animasi Fade-in */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        /* Footer */
        footer {
            margin-top: 20px;
            padding: 15px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }

        .social-icons img {
            width: 32px;
            height: 32px;
            margin: 5px;
            transition: transform 0.3s ease;
        }

        .social-icons img:hover {
            transform: scale(1.1); /* Efek hover pada ikon sosial media */
        }

        .btn-logout {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            font-size: 0.85rem;
            transition: background-color 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark animate__animated animate__fadeInDown">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Bolo Center</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('beranda') }}">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('meja-vip') }}">Meja VIP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('meja-regular') }}">Regular</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

     <!-- Konten Utama -->
     <div class="container mt-4 fade-in">
        <h1 class="text-center mb-4">Meja VIP</h1>
        <div class="row">
            @foreach($mejas as $meja)
                <div class="col-md-4 mb-4 fade-in">
                    <div class="card">
                        <img src="{{ asset('storage/' . $meja->gambar) }}" alt="{{ $meja->nama }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $meja->nama }}</h5>
                            <p class="card-text">{{ $meja->deskripsi }}</p>
                            <p class="price">Rp {{ number_format($meja->harga_per_jam, 0, ',', '.') }} / jam</p>
                            <p>ID Meja: {{ $meja->id }}</p>
                            <a href="{{ route('pembayaran.show', [$meja->id, $meja->harga_per_jam, 'vip']) }}" class="btn btn-primary">
                                Sewa
                            </a>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Footer (Sosial Media) -->
    <footer class="text-center mt-4 py-4 animate__animated animate__fadeInUp">
        <div class="social-icons mb-3">
            <a href="https://www.instagram.com/akun_anda" target="_blank" class="me-3">
                <img src="{{ asset('image/instagram-logo-png-transparent-background-1024x1024-1.png') }}" alt="Instagram">
            </a>
            <a href="https://www.tiktok.com/@bollocenter?_t=ZS-8vbUxnTIgdO&_r=1" target="_blank" class="me-3">
                <img src="{{ asset('image/tiktok-7002866_1280.png') }}" alt="TikTok">
            </a>
            <a href="https://wa.me/6281234567" target="_blank" class="me-3">
                <img src="{{ asset('image/whatsapp-icon-free-png.webp') }}" alt="WhatsApp">
            </a>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

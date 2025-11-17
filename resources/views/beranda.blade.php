<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Bolo Center</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        /* Custom CSS untuk tambahan styling */
        body {
            background: linear-gradient(135deg, #2f00ff 0%, #ff00ee 100%);
            min-height: 100vh;
            padding: 20px;
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

        .main-image {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .booking-box {
            border: 1px solid #ccc;
            padding: 15px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
        }

        .social-icons img {
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
            width: 32px;
            height: 32px;
            margin: 5px;
            transition: transform 0.3s ease;
        }

        .social-icons img:hover {
            transform: scale(1.1); /* Efek hover pada ikon sosial media */
        }

        .main-content {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
        }

        .description p {
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .address p {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .booking h3, .address h3 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        footer {
            margin-top: 20px;
            padding: 15px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }

        .btn-danger {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #dc3545; /* Warna hover untuk tombol logout */
            transform: scale(1.05);
        }

        /* Styling untuk peta */
        .map-container {
            margin-top: 15px;
            border-radius: 10px;
            overflow: hidden;
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
                        <a class="nav-link" href="{{ route('meja-regular') }}">Meja Regular</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container mt-4">
        <div class="row">
            <!-- Konten Tengah -->
            <div class="col-md-12">
                <div class="main-content animate__animated animate__fadeInUp">
                    <div class="image-container text-center mb-4">
                        <img src="{{ asset('image/billiard-7.jpg') }}" alt="Gambar Gedung" class="img-fluid rounded main-image">
                    </div>
                    <div class="description mb-4">
                        <p>Selamat datang di BoloCenter, tempat billiard dengan suasana nyaman dan fasilitas terbaik! Kami hadir untuk memberikan pengalaman bermain billiard yang seru, baik untuk pemain profesional maupun pemula yang ingin bersenang-senang. Dengan meja berkualitas tinggi, pencahayaan ideal, serta layanan ramah dari staf kami, BoloCenter siap menjadi tempat favorit Anda untuk bermain, bersosialisasi, dan mengasah keterampilan. Nikmati juga berbagai promo menarik dan event seru yang kami adakan secara rutin!</p>
                        <p>🎱 Kenapa Harus ke BoloCenter?</p>
                        <p>✅ Meja Billiard Berkualitas – Permukaan meja presisi dengan peralatan terbaik untuk permainan yang lebih akurat.</p>
                        <p>✅ Suasana Nyaman & Modern – Ruangan ber-AC, pencahayaan ideal, dan desain interior yang stylish.</p>
                        <p>✅ Harga Terjangkau – Paket bermain dengan harga kompetitif, cocok untuk semua kalangan.</p>
                        <p>✅ Minuman & Snack Lezat – Temani permainanmu dengan pilihan minuman segar dan camilan nikmat.</p>
                        <p>✅ Turnamen & Event Seru – Ikuti kompetisi dan tantang skillmu bersama komunitas billiard terbaik!</p>
                        <p>Baik untuk santai bersama teman, berlatih serius, atau sekadar mengisi waktu luang, BoloCenter adalah pilihan terbaik untuk pecinta billiard.</p>
                        <p>Kunjungi kami sekarang dan rasakan keseruannya! 🏆🎱</p>
                    </div>
                    <div class="address mb-4">
                        <h3>Alamat</h3>
                        
                        <!-- Tambahkan peta di sini -->
                        <div class="map-container">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.138936146866!2d111.04061139999999!3d-6.7529056!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70d3fc12f6cf6f%3A0x5a047a8896f47bf5!2sBELIKOPI.%20PATI!5e0!3m2!1sen!2sid!4v1740880514305!5m2!1sen!2sid"
                                width="100%"
                                height="300"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy">
                            </iframe>
                        </div>
                    </div>
                    <div class="booking">
                        <h3>Cara Booking</h3>
                        <div class="booking-box">
                            <p>Untuk melakukan booking, silakan ikuti langkah-langkah berikut:</p>
                            <ol>
                                <li>Kunjungi website kami.</li>
                                <li>Pilih jenis meja yang diinginkan (VIP atau Regular).</li>
                                <li>Isi formulir booking dengan data yang valid.</li>
                                <li>Lakukan pembayaran sesuai instruksi.</li>
                            </ol>
                        </div>
                    </div>
                    <p class="text-center mt-2 fw-bold" style="font-size: 18px;">Created by Dimas Maulana</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer (Sosial Media) -->
    <footer class="text-center mt-4 py-4 animate__animated animate__fadeInUp">
        <div class="social-icons mb-3">
            <!-- Instagram -->
            <a href="https://www.instagram.com/akun_anda" target="_blank" class="me-3">
                <img src="{{ asset('image/instagram-logo-png-transparent-background-1024x1024-1.png') }}" alt="Instagram">
            </a>
            <!-- TikTok -->
            <a href="https://www.tiktok.com/@bollocenter?_t=ZS-8vbUxnTIgdO&_r=1" target="_blank" class="me-3">
                <img src="{{ asset('image/tiktok-7002866_1280.png') }}" alt="TikTok">
            </a>
            <!-- WhatsApp -->
            <a href="https://wa.me/6281234567890" target="_blank" class="me-3">
                <img src="{{ asset('image/whatsapp-icon-free-png.webp') }}" alt="WhatsApp">
            </a>
        </div>
        <!-- Tombol Logout -->
        <form action="{{ route('logout') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
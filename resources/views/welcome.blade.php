<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ruang Konseling Online - SMK ANTARTIKA 1 SIDOARJO</title>

    <!-- Panggil Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Panggil Vite untuk aset CSS dan JS (opsional) -->@vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            /* Warna Biru SMK Antartika */
            --primary-color: #004d99;
            /* Biru gelap */
            --secondary-color: #17a2b8;
            /* Biru terang/teal */
            --accent-color: #ffc107;
            /* Kuning (untuk CTA/warning) */
            --light-blue-bg: #e6f2ff;
            /* Biru sangat muda untuk background section */
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }

        body {
            background-color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding-top: 56px;
            /* Padding dikembalikan untuk fixed navbar saja */
        }

        /* --- Navbar dan Hero Section --- */
        .navbar-brand img {
            height: 40px;
        }

        .bg-primary {
            background-color: var(--primary-color) !important;
        }

        /* Fix Navbar Display di Layar Besar */
        .navbar {
            z-index: 1030 !important;
            min-height: 70px;
        }

        .navbar-collapse {
            flex-basis: auto !important;
        }

        .navbar-nav {
            display: flex !important;
            flex-direction: row !important;
            gap: 1rem;
        }

        .nav-link {
            padding-right: 1rem !important;
            padding-left: 1rem !important;
            white-space: nowrap;
        }

        .navbar-expand-lg .navbar-collapse {
            display: flex !important;
        }

        /* Ensure toggler hanya muncul di mobile */
        @media (min-width: 992px) {
            .navbar-toggler {
                display: none !important;
            }

            .navbar-collapse {
                display: flex !important;
            }
        }

        .hero-section {
            /* Gambar background lebih full */
            background-image: linear-gradient(rgba(0, 77, 153, 0.7), rgba(0, 77, 153, 0.7)),
            url("{{ asset('images/siswa_smk.jpeg') }}");
            background-size: cover;
            background-position: center;
            height: 600px;
            /* Dipertahankan 600px agar gambar terlihat penuh */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .hero-subtitle {
            font-size: 1.8rem;
            margin-bottom: 30px;
        }

        /* --- Blok Layanan/Manfaat (Nuansa Biru) --- */
        .benefit-section {
            padding: 60px 0;
            background-color: var(--light-blue-bg);
            /* Background Biru Sangat Muda */
        }

        .benefit-card {
            background-color: white;
            /* Kartu Putih */
            color: var(--dark-color);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 20px rgba(0, 77, 153, 0.2);
            /* Shadow Biru */
            border: 3px solid var(--secondary-color);
            /* Border Biru Terang */
            transition: transform 0.3s;
        }

        .benefit-card:hover {
            transform: translateY(-5px);
        }

        .benefit-list li i {
            color: var(--primary-color);
            /* Checkmarks menggunakan Biru Primer */
            margin-right: 10px;
        }

        /* --- Konselor Section (Pengganti Testimonial) --- */
        .konselor-section {
            padding: 80px 0;
            background-color: white;
        }

        .konselor-title {
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary-color);
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .konselor-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--dark-color);
        }

        /* Mengganti .image-grid menjadi container tunggal */
        .image-container-single {
            display: flex;
            justify-content: center;
            /* Pusatkan gambar di kolom kanan */
            align-items: center;
        }

        .image-placeholder {
            /* Hapus properti grid yang lama */
            background-color: transparent;
            /* Latar belakang transparan */
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 77, 153, 0.2);
            /* Tambahkan shadow ringan ke gambar */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border: none;
            overflow: hidden;
            padding: 0;
            width: 100%;
            /* Lebar penuh di kolom lg-6 */
            max-width: 400px;
            /* Batasi ukuran agar tidak terlalu besar di desktop */
            aspect-ratio: 1 / 1;
            /* Biarkan persegi agar ilustrasi terlihat bagus */
        }

        .image-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
        }

        /* --- Perubahan Gaya FAQ: Sesuai Model yang Diinginkan --- */
        .faq-section {
            padding: 60px 0;
            background-color: white;
            /* Ubah latar belakang menjadi putih agar lebih mirip */
        }

        .faq-title {
            color: var(--primary-color);
            font-weight: 800;
            margin-bottom: 40px;
        }

        /* Style untuk Tombol Pertanyaan */
        .faq-question-button {
            /* Menghilangkan semua styling default Bootstrap Accordion */
            display: block;
            width: 100%;
            text-align: left;
            padding: 15px 0;
            background: none;
            border: none;
            border-bottom: 1px solid #dee2e6;
            /* Garis pemisah abu-abu tipis */
            color: var(--primary-color);
            /* Warna Biru Primer */
            font-size: 1.15rem;
            font-weight: 600;
            cursor: default;
            /* Ubah kursor menjadi default karena tidak ada interaksi klik yang disengaja */
            transition: color 0.2s;
            position: relative;
        }

        /* Ikon Panah (Segitiga) diubah menjadi Ikon Tanda Tanya */
        .faq-question-button i {
            margin-right: 15px;
            color: var(--primary-color);
            /* Hapus transisi transform */
            transform: none !important;
        }

        /* Konten Jawaban */
        .faq-answer {
            /* Hapus class collapse. Sekarang selalu terlihat */
            padding: 10px 0 20px 30px;
            color: var(--dark-color);
            font-size: 1rem;
            line-height: 1.6;
        }

        /* App description block (intro above benefits) */
        .app-description {
            padding: 48px 0;
            background-color: white;
            text-align: center;
            color: var(--dark-color);
        }

        .app-description h2 {
            color: var(--primary-color);
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.75rem;
        }

        .app-description p {
            max-width: 900px;
            margin: 0 auto;
            color: #444;
            line-height: 1.8;
            font-size: 1.05rem;
        }

        /* Topic Konseling Section */
        .topic-section {
            padding: 60px 0;
            background-color: white;
        }

        .topic-title {
            color: var(--primary-color);
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 15px;
        }

        .topic-subtitle {
            color: #666;
            font-size: 1rem;
            margin-bottom: 40px;
        }

        .topic-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 20px;
        }

        .topic-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 25px 20px;
            border-radius: 12px;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            text-align: center;
            min-height: 140px;
        }

        .topic-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        .topic-card i {
            font-size: 2.5rem;
            margin-bottom: 12px;
        }

        .topic-card-title {
            font-size: 1.05rem;
            font-weight: 700;
            margin: 0;
        }

        /* Topic Card Colors */
        .topic-card.pekerjaan {
            background: linear-gradient(135deg, #e6f2ff, #cce5ff);
            color: #0052cc;
        }

        .topic-card.pekerjaan i {
            color: #0052cc;
        }

        .topic-card.kendali-emosi {
            background: linear-gradient(135deg, #ffe6cc, #ffd9b3);
            color: #ff6b35;
        }

        .topic-card.kendali-emosi i {
            color: #ff6b35;
        }

        .topic-card.percintaan {
            background: linear-gradient(135deg, #ffcccc, #ffb3b3);
            color: #ff4444;
        }

        .topic-card.percintaan i {
            color: #ff4444;
        }

        .topic-card.pendidikan {
            background: linear-gradient(135deg, #ccf0ff, #99e6ff);
            color: #0099cc;
        }

        .topic-card.pendidikan i {
            color: #0099cc;
        }

        .topic-card.keluarga {
            background: linear-gradient(135deg, #ccffcc, #99ff99);
            color: #00aa00;
        }

        .topic-card.keluarga i {
            color: #00aa00;
        }

        .topic-card.kecanduan {
            background: linear-gradient(135deg, #ffe6f0, #ffc2d9);
            color: #ff6699;
        }

        .topic-card.kecanduan i {
            color: #ff6699;
        }

        .topic-card.kesehatan-mental {
            background: linear-gradient(135deg, #f0e6ff, #e6ccff);
            color: #7c3aed;
        }

        .topic-card.kesehatan-mental i {
            color: #7c3aed;
        }

        .topic-card.bullying {
            background: linear-gradient(135deg, #ffe6e6, #ffcccc);
            color: #dc2626;
        }

        .topic-card.bullying i {
            color: #dc2626;
        }

        .topic-card.akademik {
            background: linear-gradient(135deg, #fff0e6, #ffe6cc);
            color: #d97706;
        }

        .topic-card.akademik i {
            color: #d97706;
        }

        .topic-card.sosial {
            background: linear-gradient(135deg, #e6f9ff, #ccf2ff);
            color: #0891b2;
        }

        .topic-card.sosial i {
            color: #0891b2;
        }
    </style>

    <!-- Scroll animation styles -->
    <style>
        /* Base hidden state for elements that should animate when scrolled into view */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(20px) scale(0.995);
            transition: opacity 0.6s cubic-bezier(.2, .8, .2, 1), transform 0.6s cubic-bezier(.2, .8, .2, 1);
            will-change: opacity, transform;
        }

        /* Visible state applied by JS when element intersects viewport */
        .animate-on-scroll.in-view {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* Slight visual accent for tables (optional) */
        table.animate-on-scroll {
            border-collapse: collapse;
            /* add a subtle shadow while animating */
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        }

        /* Individual table row reveal (JS will set per-row delay) */
        table.animate-on-scroll tbody tr {
            opacity: 0;
            transform: translateY(8px);
            transition: opacity 0.45s ease, transform 0.45s ease;
        }

        table.animate-on-scroll.in-view tbody tr {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body>

    <!-- Navbar Utama (Disesuaikan dengan permintaan user) -->
    <!-- Struktur Navbar diperbaiki agar link dan tombol Masuk terlihat jelas di desktop -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: linear-gradient(to right, #004d99, #0066cc) !important; box-shadow: 0 2px 10px rgba(0,0,0,0.2);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#home" style="color: white !important; font-weight: bold;">
                <!-- Perlu Anda ganti dengan URL aset logo Anda yang sebenarnya -->
                <img src="{{ asset('images/logo smk.png') }}" alt="Logo SMK" class="me-2" style="height: 30px;">
                <span class="fw-bold text-uppercase">Ruang BK Online</span>
            </a>

            <!-- Tombol Toggler untuk Mobile (Wajib ada) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Container untuk Tautan Navigasi dan Tombol Masuk -->
            <div class="navbar-collapse" id="navbarNav" style="display: flex !important;">

                <!-- Tautan Navigasi (Tengah) -->
                <ul class="navbar-nav mx-auto"> <!-- mx-auto untuk pusatkan di desktop -->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#home" style="color: white !important;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" style="color: white !important;">Layanan Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak" style="color: white !important;">Kontak Kami</a>
                    </li>
                </ul>

                <!-- Tombol Masuk/Dashboard (Pojok Kanan Atas) -->
                <div class="d-flex ms-lg-auto"> <!-- ms-lg-auto memastikan tombol di kanan setelah link -->
                    @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-warning btn-lg fw-bold text-dark" style="padding: 0.5rem 2rem;">Dashboard</a>
                    @else
                    <!-- Tombol Masuk besar, diletakkan di pojok kanan -->
                    <a href="{{ route('login') }}" class="btn btn-warning btn-lg fw-bold text-dark" style="padding: 0.5rem 2rem;">Masuk</a>
                    @endauth
                </div>

            </div>

        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <h1 class="hero-title text-uppercase">Ruang Konseling Online</h1>
            <h2 class="hero-subtitle">Selamat Datang di SMK ANTARTIKA 1 SIDOARJO!</h2>

            <a href="{{ route('login') }}" class="btn btn-warning btn-lg me-2 fw-bold shadow-lg">MULAI SEKARANG</a>
            <!-- Tautan tombol diubah menjadi #layanan --><a href="#layanan" class="btn btn-outline-light btn-lg fw-bold shadow-lg">PELAJARI FITUR</a>
        </div>
    </section>

    <!-- App description (inserted above benefits) -->
    <section class="app-description">
        <div class="container">
            <h2>Apa Itu Aplikasi Bimbingan Konseling SMK Antartika 1 Sidoarjo?</h2>
            <p>
                Aplikasi Bimbingan Konseling SMK Antartika 1 Sidoarjo adalah sebuah platform digital yang dirancang untuk membantu siswa, guru, dan staf sekolah dalam mengelola dan memantau kegiatan bimbingan konseling.
                Melalui aplikasi ini, pelanggaran, poin, kasus, dan jurusan siswa dapat dikelola dengan lebih mudah dan terstruktur.
                Dengan adanya aplikasi ini, diharapkan proses bimbingan konseling menjadi lebih efektif, transparan, dan mendukung perkembangan siswa secara optimal di SMK Antartika 1 Sidoarjo.
            </p>
        </div>
    </section>

    <!-- Benefit Section -->
    <section class="benefit-section" id="layanan">
        <div class="container">
            <h2 class="mb-5 text-center fw-bold" style="color: var(--primary-color);">Manfaat Aplikasi BK Digital</h2>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="benefit-card">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="benefit-title fw-bold">Membantu Siswa Tumbuh dan Berkembang</h3>
                                <p class="lead">Sistem ini dirancang untuk memfasilitasi dan meningkatkan efisiensi kerja guru Bimbingan dan Konseling (BK) dalam menangani siswa secara digital.</p>
                            </div>
                            <div class="col-md-6">
                                <ul class="benefit-list ps-0 list-unstyled">
                                    <li class="mb-2"><i class="fas fa-check-circle"></i> Mempermudah pencatatan dan pengelolaan data konseling siswa</li>
                                    <li class="mb-2"><i class="fas fa-check-circle"></i> Meningkatkan akurasi dan aksesibilitas informasi Bimbingan dan Konseling</li>
                                    <li class="mb-2"><i class="fas fa-check-circle"></i> Mendukung komunikasi yang efektif antara guru BK, siswa, dan orang tua</li>
                                    <li class="mb-2"><i class="fas fa-check-circle"></i> Menyediakan alat untuk analisis dan pelaporan kegiatan konseling secara terstruktur</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Konselor Section (Pengganti Testimonial) -->
    <section class="konselor-section" id="konselor">
        <div class="container">
            <div class="row align-items-center">

                <!-- Kolom Kiri: Teks dan Deskripsi -->
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="konselor-title">
                        Konselor dan Guru BK Berpengalaman
                    </h2>
                    <p class="konselor-description">
                        Para pembimbing dan konselor di SMK Antartika 1 Sidoarjo merupakan guru-guru pilihan yang
                        siap mendengarkan, membimbing dan membantu para siswa yang tengah menghadapi kendala dan
                        kesulitannya baik di dalam dan luar lingkungan sekolah.
                    </p>
                </div>

                <!-- Kolom Kanan: Single Gambar Besar -->
                <div class="col-lg-6">
                    <div class="image-container-single">
                        <!-- Gambar Konselor Tunggal -->
                        <div class="image-placeholder">
                            <!-- Menggunakan asset images/fotokonseling.webp -->
                            <img src="{{ asset('images/fotokonseling.webp') }}" alt="Konselor Utama">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Topik Konseling Section -->
    <section class="topic-section" id="topik">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h2 class="topic-title">Topik Konseling</h2>
                    <p class="topic-subtitle">Topik masalah yang akan kami bantu</p>

                    <div class="topic-grid">
                        <div class="topic-card pekerjaan">
                            <i class="fas fa-briefcase"></i>
                            <p class="topic-card-title">Pekerjaan</p>
                        </div>

                        <div class="topic-card kendali-emosi">
                            <i class="fas fa-face-smile"></i>
                            <p class="topic-card-title">Kendali Emosi</p>
                        </div>

                        <div class="topic-card percintaan">
                            <i class="fas fa-heart"></i>
                            <p class="topic-card-title">Percintaan</p>
                        </div>

                        <div class="topic-card pendidikan">
                            <i class="fas fa-book"></i>
                            <p class="topic-card-title">Pendidikan</p>
                        </div>

                        <div class="topic-card keluarga">
                            <i class="fas fa-people-group"></i>
                            <p class="topic-card-title">Keluarga</p>
                        </div>

                        <div class="topic-card kecanduan">
                            <i class="fas fa-hand"></i>
                            <p class="topic-card-title">Kecanduan</p>
                        </div>

                        <div class="topic-card kesehatan-mental">
                            <i class="fas fa-brain"></i>
                            <p class="topic-card-title">Kesehatan Mental</p>
                        </div>

                        <div class="topic-card bullying">
                            <i class="fas fa-shield-exclamation"></i>
                            <p class="topic-card-title">Bullying</p>
                        </div>

                        <div class="topic-card akademik">
                            <i class="fas fa-graduation-cap"></i>
                            <p class="topic-card-title">Akademik</p>
                        </div>

                        <div class="topic-card sosial">
                            <i class="fas fa-handshake"></i>
                            <p class="topic-card-title">Hubungan Sosial</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="faq-section" id="faq">
        <div class="container">
            <h2 class="mb-5 text-center fw-bold faq-title">Pertanyaan yang Sering Diajukan (FAQ)</h2>
            <div class="row justify-content-center">
                <div class="col-lg-9">

                    <!-- Container utama untuk custom FAQ, ID dipertahankan tapi tidak digunakan sebagai parent -->
                    <div id="faqAccordion">

                        <!-- FAQ Item 1 -->
                        <div class="faq-item">
                            <!-- Tombol pertanyaan diubah. Hapus data-bs-toggle, data-bs-target, aria-expanded, dan class collapsed -->
                            <button class="faq-question-button" type="button">
                                <i class="fas fa-question-circle"></i> Apakah Aplikasi BK Digital ini?
                            </button>
                            <!-- Jawaban: Hapus class collapse (Jadikan selalu terbuka) -->
                            <div id="collapseOne" class="faq-answer">
                                <p class="mb-0">Ini adalah sistem informasi dan manajemen Bimbingan dan Konseling yang dirancang khusus untuk memfasilitasi dan mengoptimalkan layanan BK di lingkungan sekolah secara digital.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="faq-item">
                            <!-- Tombol pertanyaan diubah. Hapus data-bs-toggle, data-bs-target, aria-expanded, dan class collapsed -->
                            <button class="faq-question-button" type="button">
                                <i class="fas fa-question-circle"></i> Bagaimana cara menggunakan Aplikasi BK Digital?
                            </button>
                            <!-- Jawaban: Hapus class collapse (Jadikan selalu terbuka) -->
                            <div id="collapseTwo" class="faq-answer">
                                <p class="mb-0">Siswa dapat masuk (login) menggunakan akun yang telah disediakan sekolah, lalu dapat mengakses menu konseling, melihat jadwal, dan mengirim permintaan konsultasi kepada Guru BK.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="faq-item">
                            <!-- Tombol pertanyaan diubah. Hapus data-bs-toggle, data-bs-target, aria-expanded, dan class collapsed -->
                            <button class="faq-question-button" type="button">
                                <i class="fas fa-question-circle"></i> Apakah Aplikasi BK Digital ini berbayar?
                            </button>
                            <!-- Jawaban: Hapus class collapse (Jadikan selalu terbuka) -->
                            <div id="collapseThree" class="faq-answer">
                                <p class="mb-0">Aplikasi ini adalah bagian dari layanan sekolah dan biasanya disediakan secara gratis untuk seluruh siswa dan staf pengajar di SMK ANTARTIKA 1 SIDOARJO.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="faq-item">
                            <!-- Tombol pertanyaan diubah. Hapus data-bs-toggle, data-bs-target, aria-expanded, dan class collapsed -->
                            <button class="faq-question-button" type="button">
                                <i class="fas fa-question-circle"></i> Apakah Aplikasi BK Digital menjamin kerahasiaan?
                            </button>
                            <!-- Jawaban: Hapus class collapse (Jadikan selalu terbuka) -->
                            <div id="collapseFour" class="faq-answer">
                                <p class="mb-0">Ya, kerahasiaan data dan sesi konseling adalah prioritas utama. Semua data siswa dilindungi sesuai dengan kode etik Bimbingan dan Konseling. Hanya Guru BK yang berwenang yang dapat mengakses catatan konseling Anda.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 5 -->
                        <div class="faq-item">
                            <!-- Tombol pertanyaan diubah. Hapus data-bs-toggle, data-bs-target, aria-expanded, dan class collapsed -->
                            <button class="faq-question-button" type="button">
                                <i class="fas fa-question-circle"></i> Apakah Aplikasi BK Digital bisa digunakan sebagai sosial media?
                            </button>
                            <!-- Jawaban: Hapus class collapse (Jadikan selalu terbuka) -->
                            <div id="collapseFive" class="faq-answer">
                                <p class="mb-0">Tidak, Aplikasi BK Digital ini berfokus pada layanan Bimbingan dan Konseling resmi sekolah. Meskipun mendukung komunikasi digital, fungsinya bukan sebagai platform media sosial umum.</p>
                            </div>
                        </div>

                        <!-- Link Tambahan seperti di contoh -->
                        <div class="faq-item mt-4">
                            <a href="#" class="text-decoration-none" style="color: var(--primary-color); font-weight: 600;">
                                <i class="fas fa-angle-right me-3" style="font-size: 1.15rem;"></i> Saya ingin tahu lebih lanjut tentang BK-App
                            </a>
                            <hr class="mt-3">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="school-map">
        <h2 class="mb-5 text-center fw-bold faq-title">Lokasi SMK Antartika 1 Sidoarjo</h2>
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.943982478237!2d112.7284261!3d-7.4333114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e6a663d94b21%3A0x3a57baa5fb4760ce!2sSMK%20Antartika%201%20Sidoarjo!5e0!3m2!1sid!2sid!4v1695555555555!5m2!1sid!2sid"
                width="100%"
                height="400"
                style="border:0; border-radius: 12px; box-shadow: 0 6px 15px rgba(0,0,0,0.2);"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>

            <!-- Footer (Biru Primer), ditambahkan ID kontak -->
            <footer class="bg-primary text-white py-5" id="kontak">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 mb-4 mb-md-0">
                            <h5 class="fw-bold mb-3">Hubungi Kami</h5>
                            <p><i class="fas fa-phone me-2"></i> (031) 8962851</p>
                            <p><i class="fas fa-envelope me-2"></i> smks.antartika1.sda@gmail.com
                            </p>
                            <p><i class="fas fa-map-marker-alt me-2"></i> Jl. Raya Siwalanpanji</p>
                        </div>
                        <div class="col-md-4 mb-4 mb-md-0">
                            <h5 class="fw-bold mb-3">Ikuti Kami</h5>
                            <a href="https://share.google/R6eIjPhTgKadKJ518" target="_blank" class="btn btn-outline-light btn-sm me-2"><i class="fab fa-instagram"></i></a>
                            <a href="https://share.google/15U2v8rAA9VLBsbYc" target="_blank" class="btn btn-outline-light btn-sm me-2"><i class="fab fa-facebook"></i></a>
                            <a href="https://share.google/Wy2eD5qlRrH68np2r" target="_blank" class="btn btn-outline-light btn-sm"><i class="fab fa-youtube"></i></a>
                        </div>
                        <div class="col-md-4">
                            <h5 class="fw-bold mb-3">Link Cepat</h5>
                            <ul class="list-unstyled">
                                <li><a href="#home" class="text-white text-decoration-none">Home</a></li>
                                <li><a href="{{ route('login') }}" class="text-white text-decoration-none">Layanan</a></li>
                            </ul>
                        </div>
                    </div>
                    <hr class="bg-white my-3">
                    <p class="text-center mb-0 pt-2">&copy; 2025 Ruang Konseling Online - SMK ANTARTIKA 1 SIDOARJO. All rights reserved.</p>
                </div>
            </footer>

            <!-- Scripts Bootstrap. Tidak diperlukan lagi, tapi biarkan saja -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

            <!-- Script untuk mobile navbar toggle dan auto-close -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const navbarToggler = document.querySelector('.navbar-toggler');
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

                    // Toggle navbar di mobile saat hamburger diklik
                    if (navbarToggler) {
                        navbarToggler.addEventListener('click', function() {
                            if (navbarCollapse.style.display === 'none' || navbarCollapse.style.display === '') {
                                navbarCollapse.style.display = 'flex';
                                navbarCollapse.style.flexDirection = 'column';
                                navbarCollapse.style.backgroundColor = '#004d99';
                                navbarCollapse.style.position = 'absolute';
                                navbarCollapse.style.top = '70px';
                                navbarCollapse.style.left = '0';
                                navbarCollapse.style.right = '0';
                                navbarCollapse.style.zIndex = '1020';
                                navbarCollapse.style.padding = '1rem';
                            } else {
                                navbarCollapse.style.display = 'none';
                            }
                        });
                    }

                    // Auto-close navbar saat link diklik (mobile)
                    navLinks.forEach(link => {
                        link.addEventListener('click', function() {
                            if (window.innerWidth < 992) {
                                navbarCollapse.style.display = 'none';
                            }
                        });
                    });

                    // Update navbar display saat window resize
                    window.addEventListener('resize', function() {
                        if (window.innerWidth >= 992) {
                            navbarCollapse.style.display = 'flex';
                            navbarCollapse.style.position = 'static';
                            navbarCollapse.style.backgroundColor = 'transparent';
                            navbarCollapse.style.flexDirection = 'row';
                        }
                    });

                    // Initialize: show navbar di desktop, hide di mobile
                    if (window.innerWidth < 992) {
                        navbarCollapse.style.display = 'none';
                    } else {
                        navbarCollapse.style.display = 'flex';
                    }
                });
            </script>

            <!-- Scroll animation script: observe elements and reveal when in view -->
            <script>
                (function() {
                    function initScrollAnimations() {
                        // selectors to reveal when scrolled into view (similar to example site)
                        const revealSelectors = [
                            '.hero-title',
                            '.hero-subtitle',
                            '.hero-section .btn',
                            '.app-description',
                            '.app-description h2',
                            '.app-description p',
                            '.benefit-card',
                            '.benefit-card .benefit-title',
                            '.benefit-card p',
                            '.benefit-list li',
                            '.konselor-title',
                            '.konselor-description',
                            '.image-placeholder',
                            '.topic-title',
                            '.topic-subtitle',
                            '.topic-card',
                            '.faq-title',
                            '.faq-item',
                            '.school-map h2',
                            '.map-container',
                            'footer .col-md-4'
                        ]; // Auto-add animate class to matching elements
                        revealSelectors.forEach(sel => {
                            document.querySelectorAll(sel).forEach(el => el.classList.add('animate-on-scroll'));
                        });

                        // Keep observation for any element already marked
                        const elements = document.querySelectorAll('.animate-on-scroll');

                        if (!('IntersectionObserver' in window)) {
                            // Fallback: reveal everything immediately
                            elements.forEach(el => el.classList.add('in-view'));
                            // For list-like things, apply a small stagger
                            document.querySelectorAll('.benefit-list li, .faq-item').forEach((el, i) => {
                                el.style.transitionDelay = (i * 35) + 'ms';
                            });
                            // For tables, reveal rows immediately
                            document.querySelectorAll('table.animate-on-scroll tbody tr').forEach((tr, i) => {
                                tr.style.transitionDelay = (i * 45) + 'ms';
                                tr.style.opacity = '1';
                                tr.style.transform = 'translateY(0)';
                            });
                            return;
                        }

                        const obsOptions = {
                            root: null,
                            rootMargin: '0px 0px -12% 0px',
                            threshold: 0.12
                        };

                        const observer = new IntersectionObserver((entries) => {
                            entries.forEach(entry => {
                                const el = entry.target;
                                if (entry.isIntersecting) {
                                    // Entering viewport: add visible class and (re)apply stagger delays
                                    el.classList.add('in-view');

                                    if (el.matches && (el.matches('.benefit-card') || el.matches('.benefit-list') || el.matches('.faq-item') || el.matches('footer .col-md-4') || el.matches('.app-description'))) {
                                        const children = el.querySelectorAll('li, p, .faq-question-button, .faq-answer, h3, h2');
                                        children.forEach((ch, idx) => {
                                            ch.style.transitionDelay = (idx * 45) + 'ms';
                                        });
                                    }

                                    if (el.tagName === 'TABLE') {
                                        const rows = el.querySelectorAll('tbody tr');
                                        rows.forEach((tr, idx) => {
                                            tr.style.transitionDelay = (idx * 45) + 'ms';
                                        });
                                    }
                                } else {
                                    // Leaving viewport: remove visible class so animation can re-trigger on re-entry
                                    el.classList.remove('in-view');

                                    // Clear inline delays so they can be re-applied next time
                                    if (el.matches && (el.matches('.benefit-card') || el.matches('.benefit-list') || el.matches('.faq-item') || el.matches('footer .col-md-4') || el.matches('.app-description'))) {
                                        const children = el.querySelectorAll('li, p, .faq-question-button, .faq-answer, h3, h2');
                                        children.forEach((ch) => {
                                            ch.style.transitionDelay = '';
                                        });
                                    }

                                    if (el.tagName === 'TABLE') {
                                        const rows = el.querySelectorAll('tbody tr');
                                        rows.forEach((tr) => {
                                            tr.style.transitionDelay = '';
                                        });
                                    }
                                }
                            });
                        }, obsOptions);

                        elements.forEach(el => observer.observe(el));
                    }

                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', initScrollAnimations);
                    } else {
                        initScrollAnimations();
                    }
                })();
            </script>
</body>

</html>
@extends('layouts.app')

@section('content')
    {{--
        DATA DUMMY
        (Biasanya data ini dikirim dari Controller, tapi untuk prototyping kita taruh sini)
    --}}
    @php
        $dummyClasses = [
            [
                'title' => 'Pengenalan Laravel 11',
                'category' => 'Backend',
                'price' => 0, // 0 = GRATIS
                'desc' => 'Video pengenalan dasar framework Laravel, instalasi, dan struktur folder.',
                'duration' => '45 Menit'
            ],
            [
                'title' => 'Mastering UI/UX Design',
                'category' => 'Desain',
                'price' => 250000, // Berbayar
                'desc' => 'Panduan lengkap membuat desain aplikasi mobile yang estetik dan user-friendly.',
                'duration' => '12 Jam'
            ],
            [
                'title' => 'Basic English Conversation',
                'category' => 'Bahasa',
                'price' => 0, // GRATIS
                'desc' => 'Latihan percakapan bahasa Inggris sehari-hari untuk pemula.',
                'duration' => '1 Jam 30 Menit'
            ],
            [
                'title' => 'Fullstack Web Development',
                'category' => 'Fullstack',
                'price' => 500000, // Berbayar
                'desc' => 'Bangun website toko online dari nol sampai deploy ke server.',
                'duration' => '24 Jam'
            ],
            [
                'title' => 'Tips Lolos Interview Kerja',
                'category' => 'Karir',
                'price' => 0, // GRATIS
                'desc' => 'Tips dan trik menjawab pertanyaan HRD agar diterima kerja.',
                'duration' => '20 Menit'
            ],
            [
                'title' => 'Algoritma & Struktur Data',
                'category' => 'CS Dasar',
                'price' => 150000, // Berbayar
                'desc' => 'Pahami fondasi penting pemrograman untuk menjadi software engineer.',
                'duration' => '5 Jam'
            ],
        ];
    @endphp

    {{-- SECTION 1: JUMBOTRON --}}
    <div class="container-fluid section-jumbotron">
        <div class="jumbotron">
            <div class="jumbotron-content">
                <div class="row align-items-center">
                    <div class="col-md-5 col-7">
                        <div class="py-4 ms-4">
                            <h1 class="display-4 jumbotron-title">Tentor Sebaya</h1>
                            <p class="lead">
                                Platform belajar video interaktif. Pilih kelas gratis untuk mencoba
                                atau berlangganan premium untuk materi eksklusif.
                            </p>
                            <a href="#kelas-terbaru" class="btn btn-primary rounded-pill px-4 mt-3">Mulai Belajar</a>
                        </div>
                    </div>
                    <div class="col-md-7 col-5 jumbotron-img">
                        <div class="jumbotron-layer"></div>
                        <img src="{{ asset('assets/img/Jumbotron-img.png') }}" alt="Ilustrasi Belajar" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION 2: LIST KELAS (SWIPER) --}}
    {{-- mb-5 dan pb-5 di sini PENTING agar tidak menabrak Footer --}}
    <div id="kelas-terbaru" class="container my-5 pb-5">

        {{-- Header Section --}}
        <div class="d-flex justify-content-between align-items-center mb-4 px-md-4">
            <h3 class="new-added-title m-0">Kelas Terbaru</h3>
            <a href="#" class="text-decoration-none fw-bold" style="color: #34495e;">
                Lihat Semua <i class="fa-solid fa-arrow-right-long ms-1"></i>
            </a>
        </div>

        {{-- Wrapper Swiper (Relatif untuk tombol navigasi) --}}
        <div class="swiper-container-wrapper">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">

                    {{-- LOOP DATA --}}
                    @foreach($dummyClasses as $kelas)
                        {{-- Logika Cek Harga --}}
                        @php $isFree = $kelas['price'] == 0; @endphp

                        <div class="swiper-slide">
                            {{-- Card Utama --}}
                            {{-- Class kondisional: border-free (Hijau) atau border-premium (Emas) --}}
                            <div class="card class-card-video border-0 shadow-sm h-100 {{ $isFree ? 'border-free' : 'border-premium' }}">
                                <div class="card-body d-flex flex-column p-4 position-relative">

                                    {{-- Badge Pojok Kanan Atas --}}
                                    <div class="video-badge {{ $isFree ? 'bg-success' : 'bg-warning text-dark' }}">
                                        @if($isFree)
                                            <i class="fa-solid fa-unlock me-1"></i> GRATIS
                                        @else
                                            <i class="fa-solid fa-crown me-1"></i> PREMIUM
                                        @endif
                                    </div>

                                    {{-- Baris Kategori & Durasi --}}
                                    <div class="d-flex justify-content-between align-items-center mb-3 mt-2">
                                        <span class="badge-category-simple">{{ $kelas['category'] }}</span>
                                        <small class="text-muted" style="font-size: 0.8rem;">
                                            <i class="fa-regular fa-clock me-1"></i> {{ $kelas['duration'] }}
                                        </small>
                                    </div>

                                    {{-- Judul Kelas --}}
                                    <h5 class="card-title fw-bold text-dark mb-2">{{ $kelas['title'] }}</h5>

                                    {{-- Deskripsi Singkat --}}
                                    <p class="text-muted small mb-4">
                                        {{ Str::limit($kelas['desc'], 70) }}
                                    </p>

                                    {{-- Footer Card (Harga & Tombol) --}}
                                    <div class="mt-auto pt-3 border-top">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            @if($isFree)
                                                <span class="text-success fw-bold fs-5">Rp 0</span>
                                            @else
                                                <span class="price-text fs-5">Rp {{ number_format($kelas['price'], 0, ',', '.') }}</span>
                                            @endif
                                        </div>

                                        {{-- Tombol Aksi Berbeda --}}
                                        @if($isFree)
                                            <a href="#" class="btn btn-outline-success w-100 rounded-pill fw-bold btn-sm py-2">
                                                <i class="fa-solid fa-play me-1"></i> Tonton Sekarang
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-custom-bright w-100 rounded-pill fw-bold btn-sm py-2">
                                                <i class="fa-solid fa-lock me-1"></i> Beli Kelas
                                            </a>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- END LOOP --}}

                </div>

                {{-- Pagination (Titik-titik bawah) --}}
                <div class="swiper-pagination"></div>
            </div>

            {{-- Tombol Panah Kiri Kanan (Di luar .swiper tapi di dalam .wrapper) --}}
            <div class="swiper-button-prev custom-nav-btn"></div>
            <div class="swiper-button-next custom-nav-btn"></div>
        </div>
    </div>
@endsection

<style>
    /* =========================================
   STYLING CARD VIDEO & SWIPER (TENTOR SEBAYA)
   ========================================= */

/* 1. Wrapper Utama Swiper */
/* Memberi jarak margin bawah agar tidak menabrak footer */
.swiper-container-wrapper {
    position: relative;
    padding: 0 45px; /* Memberi ruang untuk tombol navigasi kiri-kanan */
    margin-bottom: 50px;
}

/* 2. Swiper Container */
/* Memberi ruang di dalam agar pagination titik-titik tidak menempel card */
.swiper {
    padding-bottom: 60px !important;
}

/* 3. Slide Item */
/* Memastikan tinggi otomatis agar flexbox card bekerja (h-100) */
.swiper-slide {
    height: auto !important;
    display: flex;
    justify-content: center;
    padding-bottom: 20px; /* Ruang untuk shadow card saat hover */
}

/* 4. Card Design (Tanpa Gambar) */
.class-card-video {
    width: 100%;
    border-radius: 16px;
    background: #ffffff;
    border-top: 6px solid; /* Aksen warna di atas */
    transition: all 0.3s ease;
    overflow: hidden;
}

/* Efek Hover: Naik ke atas sedikit */
.class-card-video:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
}

/* Warna Border Atas Kondisional */
.border-free {
    border-top-color: #2ecc71 !important; /* Hijau (Gratis) */
}
.border-premium {
    border-top-color: #f1c40f !important; /* Emas (Premium) */
}

/* 5. Badge Pojok Kanan Atas */
.video-badge {
    position: absolute;
    top: 0;
    right: 0;
    padding: 6px 14px;
    border-bottom-left-radius: 16px;
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 0.5px;
    color: white;
    box-shadow: -2px 2px 5px rgba(0,0,0,0.1);
    z-index: 2;
}

/* 6. Kategori Badge Kecil */
.badge-category-simple {
    background: #f8f9fa;
    color: #34495e;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    border: 1px solid #e9ecef;
}

/* 7. Harga Text */
.price-text {
    color: #2c3e50;
    font-weight: 800;
}

/* 8. Tombol Navigasi Bulat (Floating) */
.custom-nav-btn {
    width: 45px !important;
    height: 45px !important;
    background: #ffffff !important;
    border-radius: 50% !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    color: #34495e !important;
    top: 45% !important; /* Posisi Vertikal Tengah */
}

.custom-nav-btn::after {
    font-size: 18px !important;
    font-weight: bold;
}

/* Geser tombol agar sedikit keluar dari area konten */
.swiper-button-prev.custom-nav-btn { left: 0 !important; }
.swiper-button-next.custom-nav-btn { right: 0 !important; }

/* 9. Tombol Custom Premium */
.btn-custom-bright {
    background-color: #34495e;
    color: white;
    border: none;
    transition: all 0.3s;
}
.btn-custom-bright:hover {
    background-color: #2c3e50;
    transform: translateY(-2px);
    color: white;
}
</style>

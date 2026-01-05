@extends('layouts.app')

@section('content')

{{-- =========================================================
|   HEADER / HERO SECTION
|========================================================= --}}
<section class="bg-dark py-5 text-white border-bottom border-secondary">
    <div class="container">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="text-white-50 text-decoration-none">Home</a>
                </li>
                <li class="breadcrumb-item text-white-50">
                    {{ $course->category->name }}
                </li>
                <li class="breadcrumb-item active text-white">
                    Detail Kelas
                </li>
            </ol>
        </nav>

        {{-- Title --}}
        <div class="row">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold">{{ $course->title }}</h1>
                <p class="lead text-white-50 mt-3">
                    {{ Str::limit($course->description, 150) }}
                </p>

                <div class="d-flex flex-wrap gap-4 mt-4 text-white-50">
                    <span><i class="fa-solid fa-star text-warning me-1"></i> 4.9 (210 Review)</span>
                    <span><i class="fa-solid fa-user-tie me-2"></i> Admin Tentor</span>
                    <span><i class="fa-regular fa-clock me-2"></i> {{ $course->duration }}</span>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- =========================================================
|   MAIN CONTENT
|========================================================= --}}
<section class="container my-5">

    {{-- WRAPPER CUSTOM (Ganti 'row' dengan ini agar layout flexbox bekerja) --}}
    <div class="course-layout-wrapper">

        {{-- =================================================
        | LEFT CARD (VIDEO + SCROLLABLE CONTENT)
        |================================================= --}}
        <div class="card-sidebar-main">

            {{-- ID video-player ditambahkan untuk target scroll tombol --}}
            <div id="video-player" class="card-side-bar-sub border-0 shadow-sm rounded-4 overflow-hidden course-card">

                {{-- VIDEO AREA (Fixed Top) --}}
                <div class="ratio ratio-16x9">
                    {{-- LOGIKA: Jika Punya Akses (Gratis / Premium) -> Tampilkan Video --}}
                    @if ($isAccessGranted)
                        <iframe
                            src="https://www.youtube.com/embed/{{ $course->video_url }}"
                            allowfullscreen
                            style="border:0">
                        </iframe>
                    @else
                        {{-- Jika Tidak Punya Akses -> Tampilkan Gembok --}}
                        <div class="bg-dark text-white text-center d-flex flex-column justify-content-center align-items-center h-100 p-4">
                            <i class="fa-solid fa-lock fa-3x text-warning mb-3"></i>
                            <h4 class="fw-bold">Konten Premium</h4>
                            <span class="text-white-50">Upgrade akun menjadi Premium untuk membuka akses.</span>
                        </div>
                    @endif
                </div>

                {{-- SCROLLABLE CONTENT BODY --}}
                <div class="card-body-sub course-card-body">

                    <h4 class="fw-bold mb-3">Tentang Kelas Ini</h4>
                    <p class="text-muted mb-4">
                        {{ $course->description }}
                    </p>

                    <h6 class="fw-bold mb-3">Yang akan dipelajari</h6>
                    <ul class="list-unstyled mb-0">
                        @foreach (['Memahami konsep dasar', 'Studi kasus nyata', 'Best practice industri', 'Akses source code'] as $item)
                            <li class="d-flex align-items-start mb-2">
                                <i class="fa-solid fa-check text-success me-2 mt-1"></i>
                                <span class="text-muted">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>

        </div>

        {{-- =================================================
        | RIGHT SIDEBAR (STATUS & AKSI)
        |================================================= --}}
        <div class="card-sidebar">
            <div class="card-side-bar-sub border-0 shadow-sm rounded-4 p-4 course-sidebar">

                <span class="text-muted small fw-semibold">Status Akses</span>

                <div class="my-3">
                    @if ($course->price == 0)
                        <h3 class="fw-bold text-success mb-0">Gratis</h3>
                        <small class="text-muted">Terbuka untuk semua member</small>
                    @else
                        <h3 class="fw-bold text-dark mb-0">Premium</h3>
                        <small class="text-muted">Khusus Member Premium</small>
                    @endif
                </div>

                <hr>

                {{-- LOGIKA TOMBOL AKSI --}}
                <div class="mb-4">
                    @if($isAccessGranted)
                        {{-- KONDISI 1: SUDAH PUNYA AKSES --}}
                        <a href="#video-player" class="btn btn-success w-100 rounded-pill py-3 fw-bold shadow-sm">
                            <i class="fa-solid fa-play me-2"></i>
                            Mulai Belajar
                        </a>
                    @else
                        {{-- KONDISI 2: BELUM PUNYA AKSES (Harus Upgrade) --}}
                        <div class="alert alert-warning small border-0 mb-3 d-flex align-items-start">
                            <i class="fa-solid fa-circle-info mt-1 me-2"></i>
                            <div>Kelas ini dikunci. Jadilah member Premium untuk akses tanpa batas.</div>
                        </div>

                        {{-- Arahkan ke route checkout premium (Nanti kita buat) --}}
                        {{-- Sementara gunakan # --}}
                        <a href="{{ route('subscription.index') }}" class="btn btn-custom-bright w-100 rounded-pill py-3 fw-bold shadow-sm">
                            <i class="fa-solid fa-crown me-2"></i>
                            Upgrade Premium
                        </a>
                    @endif
                </div>

                {{-- FITUR LIST (Scrollable) --}}
                <div class="course-sidebar-body">
                    <h6 class="fw-bold small mb-3 text-uppercase text-muted">Detail Kursus</h6>
                    <ul class="list-unstyled small text-muted mb-0">
                        <li class="d-flex justify-content-between mb-2">
                            <span><i class="fa-regular fa-clock me-2"></i> Durasi</span>
                            <strong>{{ $course->duration }}</strong>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span><i class="fa-solid fa-download me-2"></i> Materi</span>
                            <strong>Download</strong>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span><i class="fa-solid fa-certificate me-2"></i> Sertifikat</span>
                            <strong>Ya</strong>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span><i class="fa-solid fa-infinity me-2"></i> Akses</span>
                            <strong>Selamanya</strong>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection

{{-- =========================================================
|   PAGE STYLES (CUSTOM CSS)
|========================================================= --}}
<style>
    /* ===============================
       LAYOUT WRAPPER (Flexbox System)
       Menggantikan Row Bootstrap
    ================================ */
    .course-layout-wrapper {
        display: flex;
        gap: 30px; /* Jarak antar kolom kiri dan kanan */
        align-items: flex-start; /* Penting untuk Sticky Sidebar */
    }

    /* ===============================
       LEFT COLUMN (VIDEO CARD)
    ================================ */
    .card-sidebar-main {
        flex: 1; /* Mengisi sisa ruang yang ada */
        min-width: 0; /* Mencegah overflow pada konten flex */
    }

    .course-card {
        background: white;
        height: 600px; /* Tinggi Tetap agar scroll internal jalan */
        display: flex;
        flex-direction: column;
    }

    /* Video Wrapper (Fixed ratio) */
    .course-card .ratio {
        flex-shrink: 0; /* Jangan mengecil */
        background-color: #000;
    }

    /* Scrollable Content Area */
    .course-card-body {
        flex: 1;
        overflow-y: auto; /* Scroll vertikal jika konten panjang */
        padding: 2rem;
    }

    /* ===============================
       RIGHT COLUMN (SIDEBAR)
    ================================ */
    .card-sidebar {
        width: 380px; /* Lebar Tetap Sidebar */
        flex-shrink: 0; /* Jangan mengecil */
    }

    .course-sidebar {
        background: white;
        position: sticky; /* Menempel saat scroll */
        top: 100px; /* Jarak dari atas layar */
        max-height: calc(100vh - 120px);
        display: flex;
        flex-direction: column;
    }

    .course-sidebar-body {
        overflow-y: auto;
        padding-right: 5px;
    }

    /* ===============================
       SCROLLBAR STYLING
    ================================ */
    ::-webkit-scrollbar {
        width: 6px;
    }
    ::-webkit-scrollbar-thumb {
        background-color: #ced4da;
        border-radius: 10px;
    }
    ::-webkit-scrollbar-track {
        background: transparent;
    }

    /* ===============================
       MOBILE RESPONSIVE
    ================================ */
    @media (max-width: 991px) {
        /* Ubah layout jadi menumpuk ke bawah */
        .course-layout-wrapper {
            flex-direction: column;
        }

        .card-sidebar {
            width: 100%; /* Sidebar jadi lebar penuh */
        }

        /* Matikan scroll internal di HP agar scroll halaman biasa */
        .course-card {
            height: auto;
        }

        .course-sidebar {
            position: static;
            max-height: none;
        }
    }

    /* Breadcrumb color fix */
    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.5);
    }
</style>

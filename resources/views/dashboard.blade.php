@extends('layouts.app')

@section('content')

{{-- HEADER / BANNER --}}
<div class="bg-dark text-white py-5 border-bottom border-secondary" style="margin-top: 55px">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold">Jelajahi Kelas</h1>
                <p class="lead text-white-50">Tingkatkan skill codingmu dengan materi berkualitas dari mentor berpengalaman.</p>
            </div>
            <div class="col-lg-6 text-lg-end">
                {{-- Tampilkan Status User di Header --}}
                @auth
                    @if(Auth::user()->is_premium)
                        <div class="d-inline-block bg-success text-white px-4 py-2 rounded-pill fw-bold shadow-sm border border-success">
                            <i class="fa-solid fa-crown me-2"></i> MEMBER PREMIUM
                        </div>
                    @else
                        <a href="{{ route('subscription.index') }}" class="btn btn-outline-warning rounded-pill px-4 fw-bold">
                            <i class="fa-solid fa-crown me-2"></i> Upgrade Premium
                        </a>
                    @endif
                @else
                @endauth
            </div>
        </div>
    </div>
</div>

{{-- DAFTAR KELAS --}}
<div class="container my-5">

    {{-- ==========================================
       UPDATE: FORM PENCARIAN + DROPDOWN
    ========================================== --}}

    {{-- Kita bungkus semua dalam satu form agar Search & Kategori bekerja bersamaan --}}
    <form action="{{ route('dashboard') }}" method="GET">
        <div class="row mb-5 align-items-center justify-content-between">

            {{-- Bagian Kiri: Judul atau Info --}}
            <div class="col-md-4 mb-3 mb-md-0">
                <h4 class="fw-bold mb-0 text-white">
                    @if(request('category'))
                        Kategori: <span class="text-primary">{{ $categories->firstWhere('slug', request('category'))->name }}</span>
                    @elseif(request('search'))
                        Hasil: "{{ request('search') }}"
                    @else
                        Semua Kelas
                    @endif
                </h4>
                <p class="text-white small mb-0">Menampilkan {{ $courses->count() }} kursus tersedia</p>
            </div>

            {{-- Bagian Kanan: Input Search & Dropdown --}}
            <div class="col-md-8">
                <div class="row g-2">

                    {{-- 1. Input Pencarian --}}
                    <div class="col-md-7 col-lg-8">
                        <div class="input-group shadow-sm rounded-pill overflow-hidden bg-white border">
                            <span class="input-group-text bg-white border-0 ps-4">
                                <i class="fa-solid fa-magnifying-glass text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-0 py-2"
                                   placeholder="Cari kelas..."
                                   value="{{ request('search') }}">
                        </div>
                    </div>

                    {{-- 2. Dropdown Kategori --}}
                    <div class="col-md-5 col-lg-4">
                        <div class="position-relative">
                            {{-- Icon Filter (Hiasan) --}}
                            <i class="fa-solid fa-filter position-absolute text-muted"
                               style="top: 50%; left: 15px; transform: translateY(-50%); z-index: 10;"></i>

                            {{-- Select Input --}}
                            {{-- onchange="this.form.submit()" membuat form otomatis dikirim saat user memilih opsi --}}
                            <select name="category" class="form-select border shadow-sm rounded-pill ps-5 py-2 fw-bold text-muted cursor-pointer"
                                    onchange="this.form.submit()"
                                    style="background-color: #fff;">

                                <option value="">Semua Kategori</option>

                                @foreach($categories as $cat)
                                    <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </form>

    {{-- ==========================================
       GRID KELAS (Tetap Sama)
    ========================================== --}}
    <div class="row g-4">
        {{-- ... Kode Loop Foreach Courses Anda di sini (tidak perlu diubah) ... --}}
    </div>
</div>

    {{-- ==========================================
       GRID KELAS (Kode Lama Anda di bawah ini)
    ========================================== --}}

    <div class="row g-4 mb-5">
        {{-- Jika Hasil Pencarian Kosong --}}
        @if($courses->count() == 0)
            <div class="col-12 text-center py-5">
                <div class="mb-3">
                    <i class="fa-solid fa-box-open fa-3x text-white"></i>
                </div>
                <h4 class="fw-bold text-white">Kelas tidak ditemukan</h4>
                <p class="text-white">Coba kata kunci lain atau reset filter.</p>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-primary rounded-pill">Reset Pencarian</a>
            </div>
        @else
            {{-- Loop Kartu (Kode yang sudah ada sebelumnya) --}}
            @foreach($courses as $kelas)
               {{-- ... Biarkan kode kartu yang tadi ... --}}
               {{-- PASTIKAN LOOP FOREACH LAMA ANDA ADA DI SINI --}}
            @endforeach
        @endif
    </div>

    </div>

    <div class="row g-4" style="margin-left: 110px; margin-bottom: 40px;">
        @foreach($courses as $kelas)
            {{-- LOGIKA PENENTUAN AKSES --}}
            @php
                $isFree = $kelas->price == 0;
                $isLoggedIn = Auth::check(); // Cek apakah user sudah login
                $isPremiumUser = $isLoggedIn && Auth::user()->is_premium;

                // User boleh nonton jika: Kelasnya Gratis ATAU Usernya Premium
                $canAccess = $isFree || $isPremiumUser;
            @endphp

            <div class="col-md-2">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden course-card-hover">

                    {{-- Thumbnail / Badge --}}
                    <div class="position-relative bg-light overflow-hidden" style="height: 200px;">
                        @if($kelas->thumbnail)
                            {{-- Jika ada gambar upload, pakai itu --}}
                            <img src="{{ asset('storage/' . $kelas->thumbnail) }}"
                                class="w-100 h-100 object-fit-cover" alt="{{ $kelas->title }}">
                        @else
                            {{-- Jika tidak ada, pakai dummy --}}
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($kelas->title) }}&background=random&size=400"
                                class="w-100 h-100 object-fit-cover" alt="{{ $kelas->title }}">
                        @endif

                        {{-- Badge Status tetap di sini --}}
                        <div class="position-absolute top-0 end-0 m-3">
                            @if($isFree)
                                <span class="badge bg-success shadow-sm">GRATIS</span>
                            @else
                                <span class="badge bg-dark shadow-sm"><i class="fa-solid fa-crown text-warning"></i> PREMIUM</span>
                            @endif
                        </div>
                    </div>

                    <div class="card-body p-4 d-flex flex-column">
                        <small class="text-primary fw-bold text-uppercase mb-2" style="font-size: 0.75rem; letter-spacing: 1px;">
                            {{ $kelas->category->name }}
                        </small>

                        <h5 class="card-title fw-bold text-dark mb-2">{{ $kelas->title }}</h5>

                        <p class=" small mb-4 flex-grow-1">
                            {{ Str::limit($kelas->description, 80) }}
                        </p>

                        <div class="d-flex justify-content-between align-items-cente small mb-3 border-top pt-3">
                            <span><i class="fa-regular fa-clock me-1"></i> {{ $kelas->duration }}</span>
                            <span><i class="fa-solid fa-users me-1"></i> 120 Siswa</span>
                        </div>

                        {{-- ======================================================
                           LOGIKA TOMBOL UTAMA
                           ====================================================== --}}

                        @if($canAccess)
                            {{-- KONDISI 1: User Boleh Akses (Gratis / Premium) --}}
                            <a href="{{ route('course.show', $kelas->slug) }}" class="btn btn-success w-100 rounded-pill fw-bold py-2">
                                <i class="fa-solid fa-play me-2"></i> Tonton Sekarang
                            </a>

                        @else
                            {{-- KONDISI 2: Kelas Berbayar & Akses Ditolak --}}

                            @if($isLoggedIn)
                                {{-- Sub-Kondisi A: Sudah Login tapi Masih Free (Belum Premium) --}}
                                {{-- Arahkan ke detail untuk lihat penawaran upgrade --}}
                                <a href="{{ route('course.show', $kelas->slug) }}" class="btn btn-outline-dark w-100 rounded-pill fw-bold py-2">
                                    <i class="fa-solid fa-lock me-2"></i> Akses Premium
                                </a>

                            @else
                                {{-- Sub-Kondisi B: BELUM LOGIN (GUEST) --}}
                                {{-- Arahkan ke Login dengan Peringatan --}}
                                <a href="{{ route('login') }}"
                                   class="btn btn-primary w-100 rounded-pill fw-bold py-2"
                                   onclick="return alert('Maaf, ini adalah Konten Premium.\n\nSilakan LOGIN atau DAFTAR terlebih dahulu untuk melihat detail kelas ini.')">
                                    <i class="fa-solid fa-right-to-bracket me-2"></i> Login untuk Akses
                                </a>
                            @endif

                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

@endsection

@section('styles')
<style>
    .course-card-hover {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .course-card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
</style>
@endsection

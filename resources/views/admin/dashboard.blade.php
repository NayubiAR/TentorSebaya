@extends('layouts.app')

@section('content')

<div class="bg-dark py-5 text-white">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="fw-bold mb-0">Admin Console</h1>
                <p class="text-white-50 mb-0">Kelola konten website dari sini.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-light rounded-pill">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Website
            </a>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row g-4">

        {{-- MENU 1: KELOLA KELAS --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body p-4 text-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fa-solid fa-video fa-xl"></i>
                    </div>
                    <h5 class="fw-bold">Kelola Kelas</h5>
                    <p class="text-muted small">Tambah, edit, atau hapus materi kursus yang tersedia.</p>
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-primary w-100 rounded-pill fw-bold">
                        Buka Menu
                    </a>
                </div>
            </div>
        </div>

        {{-- MENU 2: KELOLA TRANSAKSI (Next Project) --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body p-4 text-center">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fa-solid fa-receipt fa-xl"></i>
                    </div>
                    <h5 class="fw-bold">Data Transaksi</h5>
                    <p class="text-muted small">Lihat riwayat pembelian dan status pembayaran user.</p>
                    <button class="btn btn-outline-secondary w-100 rounded-pill fw-bold" disabled>
                        Segera Hadir
                    </button>
                </div>
            </div>
        </div>

         {{-- MENU 3: KELOLA USER (Next Project) --}}
         <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body p-4 text-center">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fa-solid fa-users fa-xl"></i>
                    </div>
                    <h5 class="fw-bold">Data Pengguna</h5>
                    <p class="text-muted small">Kelola akun member premium dan user terdaftar.</p>
                    <button class="btn btn-outline-secondary w-100 rounded-pill fw-bold" disabled>
                        Segera Hadir
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

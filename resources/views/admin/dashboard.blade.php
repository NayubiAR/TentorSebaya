@extends('layouts.app')

@section('content')

{{-- Header --}}
<div class="bg-dark py-5 text-white">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="fw-bold mb-0">Admin Console</h1>
                <p class="text-white-50 mb-0">Ringkasan aktivitas website Anda.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-light rounded-pill">
                <i class="fa-solid fa-arrow-left me-2"></i> Lihat Website
            </a>
        </div>
    </div>
</div>

<div class="container my-5">

    {{-- STATISTIK REAL-TIME (BARU) --}}
    <div class="row g-4 mb-5">

        {{-- Card 1: Total Kelas --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 text-white" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 text-uppercase mb-2">Total Kelas</h6>
                            <h2 class="fw-bold mb-0">{{ $totalCourses }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fa-solid fa-video fa-lg text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 2: Total Siswa --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 text-white" style="background: linear-gradient(135deg, #198754 0%, #157347 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 text-uppercase mb-2">Total Siswa</h6>
                            <h2 class="fw-bold mb-0">{{ $totalUsers }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fa-solid fa-users fa-lg text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 3: Member Premium --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 text-white" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 text-uppercase mb-2">Member Premium</h6>
                            <h2 class="fw-bold mb-0">{{ $premiumUsers }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fa-solid fa-crown fa-lg text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- MENU KELOLA (YANG LAMA) --}}
    <h5 class="fw-bold mb-3">Menu Manajemen</h5>
    <div class="row g-4">

        {{-- MENU 1: KELOLA KELAS --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body p-4 text-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fa-solid fa-laptop-code fa-xl"></i>
                    </div>
                    <h5 class="fw-bold">Kelola Kelas</h5>
                    <p class="text-muted small">Tambah, edit, upload thumbnail, atau hapus materi kursus.</p>
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-primary w-100 rounded-pill fw-bold">
                        Buka Menu
                    </a>
                </div>
            </div>
        </div>

        {{-- MENU LAINNYA --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 rounded-4 opacity-50">
                <div class="card-body p-4 text-center">
                    <div class="bg-secondary bg-opacity-10 text-secondary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fa-solid fa-list fa-xl"></i>
                    </div>
                    <h5 class="fw-bold">Kelola Kategori</h5>
                    <p class="text-muted small">Tambah atau edit kategori kursus.</p>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-dark w-100 rounded-pill fw-bold">
                        Kelola Sekarang
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
